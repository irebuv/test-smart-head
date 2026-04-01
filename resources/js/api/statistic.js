const statsDay = document.getElementById("statistic-day");

if (statsDay) {
    document.addEventListener("DOMContentLoaded", async () => {
        try {
            const response = await fetch("/api/tickets/statistic", {
                headers: {
                    Accept: "application/json",
                },
            });

            const data = await response.json();

            document.getElementById("statistic-day").textContent =
                data.day;
            document.getElementById("statistic-week").textContent =
                data.week;
            document.getElementById("statistic-month").textContent =
                data.month;
        } catch (error) {
            console.error(error);
        }
    });
}
