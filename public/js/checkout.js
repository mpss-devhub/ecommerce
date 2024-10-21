document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".showFormLink").forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const paymentCode = this.getAttribute("data-code");
            const paymentTypeContainer =
                this.closest(".pay-list").parentNode.parentNode;
            const paymentTypeElement = paymentTypeContainer.querySelector("h2");
            const paymentType = paymentTypeElement
                ? paymentTypeElement.innerText.trim()
                : "";
            console.log("Selected Payment Code:", paymentCode);
            console.log("Selected Payment Type:", paymentType);
            document.getElementById("selectedPaymentCode").value = paymentCode;
            showModal(paymentType);
        });
    });
    const modal = document.getElementById("myModal");
    const closeModalBtn = document.getElementsByClassName("close")[0];
    const modalHeader = document.getElementById("modalHeader");

    function showModal(paymentType) {
        modalHeader.innerText = `${paymentType} Payment Information`;
        modal.style.display = "block";
    }

    function hideModal() {
        modal.style.display = "none";
        resetForm();
    }

    closeModalBtn.onclick = function () {
        hideModal();
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            hideModal();
        }
    };

    function resetForm() {
        document.getElementById("phoneNo").value = "";
        document.getElementById("email").value = "";
        document.getElementById("name").value = "";
        document.getElementById("selectedPaymentCode").value = "";
        document.querySelector(".QR-block").style.display = "none";
    }

    document
        .querySelector(".paySubmit")
        .addEventListener("click", function (event) {
            event.preventDefault();

            const submitButton = this;
            submitButton.disabled = true;

            $.ajax({
                type: "POST",
                url: "/checkout",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                contentType: "application/json",
                data: JSON.stringify({
                    phoneNo: $("#phoneNo").val(),
                    email: $("#email").val(),
                    name: $("#name").val(),
                    selectedPaymentCode: $("#selectedPaymentCode").val(),
                    _token: $('meta[name="csrf-token"]').attr("content"),
                }),
                success: function (response) {
                    console.log(response);
                    if (response.message) {
                        toastr.error(response.message);
                        submitButton.disabled = false;
                    } else if (response.data) {
                        if (response.data.type === "QR") {
                            const qrImageElement =
                                document.querySelector(".QR-block img");
                            qrImageElement.src = response.data.data;
                            document.querySelector(".QR-block").style.display =
                                "block";
                        } else if (response.data.type === "DEEP_LINK") {
                            window.location.href = response.data.data;
                        } else if (response.data.type === "REDIRECT_URL") {
                            window.location.href = response.data.data;
                        } else if (response.data.type === "MESSAGE") {
                            toastr.success(response.data.data);
                            setTimeout(function () {
                                window.location.href = "/";
                            }, 100);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error occurred: ", error);
                    toastr.error("An error occurred. Please try again.");
                    submitButton.disabled = false;
                },
            });
        });
});
