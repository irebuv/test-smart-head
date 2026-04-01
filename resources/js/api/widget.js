// Form in widget via AJAX to /api/tickets
const form = document.getElementById("ticket-form");

if (form) {
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("ticket-form");
        const message = document.getElementById("form-message");

        if (!form) return;

        form.addEventListener("submit", async (event) => {
            event.preventDefault();

            message.textContent = "";
            message.className = "small";

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

                const contentType = response.headers.get("content-type") || "";

                let data = null;

                if (contentType.includes("application/json")) {
                    data = await response.json();
                    console.log(data);
                } else {
                    const text = await response.json();
                    console.log(text);
                    throw new Error(`Unexpected response: ${response.status}`);
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
                    } else {
                        message.textContent =
                            data.message ?? "Validation error";
                        message.classList.add("text-danger");
                    }

                    return;
                }

                message.textContent = data.message ?? "Successfully sent";
                message.classList.add("text-success");
                form.reset();
            } catch (error) {
                message.textContent = "Something went wrong";
                message.classList.add("text-danger");
            }
        });
    });
}
