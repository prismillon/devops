FROM rust
EXPOSE 8080
RUN cargo new --bin app
WORKDIR /app
COPY Cargo.* /app/.
RUN cargo build --release
COPY src/*.rs /app/src/.
RUN echo "// force Cargo cache invalidation" >> /app/src/main.rs
RUN cargo build --release
USER 1000
CMD /app/target/release/devops
