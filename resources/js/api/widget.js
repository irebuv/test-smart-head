// Form in widget via AJAX to /api/tickets
const form = document.getElementById("ticket-form");

if (form) {
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("ticket-form");
        const message = document.getElementById("form-message");
        const success = document.getElementById("success-block");

        if (!form) return;

        form.addEventListener("submit", async (event) => {
            event.preventDefault();

            console.log("submit started");

            if (message) {
                message.textContent = "";
                message.className = "small";
            }

            if (success) {
                success.classList.add("d-none");
                success.classList.remove("d-flex");
            }

            form.querySelectorAll(".form-control").forEach((input) => {
                input.classList.remove("is-invalid");
            });

            form.querySelectorAll(".input-error").forEach((block) => {
                block.textContent = "";
            });

            const formData = new FormData(form);

            try {
                const response = await fetch("/api/tickets", {
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                    },
                    body: formData,
                });

                console.log("status:", response.status);

                const contentType = response.headers.get("content-type") || "";
                console.log("content-type:", contentType);

                let data;

                if (contentType.includes("application/json")) {
                    data = await response.json();
                    console.log("json data:", data);
                } else {
                    const text = await response.text();
                    console.log("non-json response:", text);
                    throw new Error(
                        `Unexpected response type. Status: ${response.status}`,
                    );
                }

                if (!response.ok) {
                    if (data.errors) {
                        Object.entries(data.errors).forEach(
                            ([field, messages]) => {
                                let normalizedField = field;

                                if (field.startsWith("files")) {
                                    normalizedField = "files";
                                }

                                const input =
                                    form.querySelector(
                                        `[name="${normalizedField}"]`,
                                    ) ||
                                    form.querySelector(
                                        `[name="${normalizedField}[]"]`,
                                    );

                                const errorBlock = document.getElementById(
                                    `error-${normalizedField}`,
                                );

                                if (input) {
                                    input.classList.add("is-invalid");
                                }

                                if (errorBlock) {
                                    errorBlock.textContent = messages[0];
                                }
                            },
                        );
                    } else if (message) {
                        message.textContent =
                            data.message ?? "Validation error";
                        message.classList.add("text-danger");
                    }

                    return;
                }

                if (message) {
                    message.textContent = data.message ?? "Successfully sent";
                    message.classList.add("text-success");
                }

                if (success) {
                    success.classList.remove("d-none");
                    success.classList.add("d-flex");
                }

                form.reset();
            } catch (error) {
                console.error("CATCH ERROR:", error);

                if (message) {
                    message.textContent = "Something went wrong";
                    message.classList.add("text-danger");
                }
            }
        });
    });
}

const success = document.getElementById("success-block");

if (success) {
    success.addEventListener("click", () => {
        success.classList.add("d-none");
        success.classList.remove("d-flex");
    });
}
