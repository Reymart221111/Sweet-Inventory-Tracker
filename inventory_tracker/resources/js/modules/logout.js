export function initializeModal() {
    window.openModal = function() {
        document.getElementById("logoutModal").classList.remove("hidden");
    }

    window.closeModal = function() {
        document.getElementById("logoutModal").classList.add("hidden");
    }
}
