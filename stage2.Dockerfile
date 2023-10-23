FROM rust AS builder
ENV RUSTFLAGS='-C target-feature=+crt-static'
RUN cargo new --bin app
WORKDIR /app
COPY Cargo.* /app/.
RUN cargo build --release --target x86_64-unknown-linux-gnu
COPY src/*.rs /app/src/.
RUN echo "// force Cargo cache invalidation" >> /app/src/main.rs
RUN cargo build --release --bins --target x86_64-unknown-linux-gnu

FROM scratch
EXPOSE 8080
COPY --from=builder /app/target/x86_64-unknown-linux-gnu/release/devops /app
CMD ["./app"]