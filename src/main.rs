use actix_web::{get, App, HttpResponse, HttpServer, Responder, HttpRequest, middleware::Logger, http::header::ContentType};
use std::env::var;
use env_logger::Env;

#[get("/ping")]
async fn ping(req: HttpRequest) -> impl Responder {

    let headers = req.headers();
    let mut header_string: String = "{".to_owned();

    for (name, value) in headers.iter() {
        let escaped_value = value.to_str().unwrap_or("Invalid UTF-8").replace("\"", "\\\"");
        header_string.push_str(&format!("\"{}\":\"{}\",", name, escaped_value));
    };
    header_string.pop();
    header_string.push_str("}");

    HttpResponse::Ok().content_type(ContentType::json()).body(header_string)
}

#[actix_web::main]
async fn main() -> std::io::Result<()> {
    env_logger::init_from_env(Env::default().default_filter_or("info"));

    let listen_port = match var("PING_LISTEN_PORT") {
        Ok(s) => s.parse().unwrap_or(8080),
        Err(_) => 8080,
    };
    println!("actix-web starting on port {}", listen_port);
    HttpServer::new(|| {
        App::new()
            .service(ping)
            .wrap(Logger::default())
            .wrap(Logger::new("%a %{User-Agent}i"))
    })
    .bind(("0.0.0.0", listen_port))?
    .run()
    .await
}
