import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".offer-exchange-btn").forEach(button => {
        button.addEventListener("click", function () {
            const offeredPostId = this.dataset.offeredPostId;
            const requestedPostId = this.dataset.requestedPostId;

            fetch("/exchange/offer", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    offered_post_id: offeredPostId,
                    requested_post_id: requestedPostId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Exchange request sent successfully!");
                } else {
                    alert(data.error || "Something went wrong.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });

    document.querySelectorAll(".respond-exchange-btn").forEach(button => {
        button.addEventListener("click", function () {
            const exchangeId = this.dataset.exchangeId;
            const status = this.dataset.status;

            fetch(`/exchange/respond/${exchangeId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Exchange request updated!");
                    window.location.reload();
                } else {
                    alert(data.error || "Something went wrong.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});
window.offerExchange = function (button) {
    const offeredPostId = button.dataset.offeredPostId;
    const requestedPostId = button.dataset.requestedPostId;

    fetch("/exchange/offer", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            offered_post_id: offeredPostId,
            requested_post_id: requestedPostId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Exchange request sent successfully!");
        } else {
            alert(data.error || "Something went wrong.");
        }
    })
    .catch(error => console.error("Error:", error));
};
