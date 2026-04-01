(() => {
    const FAVORITES_KEY = "jcpedia:favorites";

    function initDropdowns() {
        const dropdowns = document.querySelectorAll(".dropdown");

        dropdowns.forEach((dropdown) => {
            const toggle = dropdown.querySelector(".dropdown-toggle");
            if (!toggle) {
                return;
            }

            toggle.setAttribute("aria-expanded", "false");

            toggle.addEventListener("click", (event) => {
                event.stopPropagation();
                const isOpen = dropdown.classList.toggle("is-open");
                toggle.setAttribute("aria-expanded", String(isOpen));
            });
        });

        document.addEventListener("click", (event) => {
            dropdowns.forEach((dropdown) => {
                if (dropdown.contains(event.target)) {
                    return;
                }
                dropdown.classList.remove("is-open");
                const toggle = dropdown.querySelector(".dropdown-toggle");
                if (toggle) {
                    toggle.setAttribute("aria-expanded", "false");
                }
            });
        });

        document.addEventListener("keydown", (event) => {
            if (event.key !== "Escape") {
                return;
            }

            dropdowns.forEach((dropdown) => {
                dropdown.classList.remove("is-open");
                const toggle = dropdown.querySelector(".dropdown-toggle");
                if (toggle) {
                    toggle.setAttribute("aria-expanded", "false");
                }
            });
        });
    }

    function initSearch() {
        const input = document.getElementById("brandSearch");
        if (!input) {
            return;
        }

        const cards = document.querySelectorAll(".car-selection-container[data-brand]");
        input.addEventListener("input", () => {
            const query = input.value.trim().toLowerCase();
            cards.forEach((card) => {
                const brand = (card.getAttribute("data-brand") || "").toLowerCase();
                const isMatch = brand.includes(query);
                card.style.display = isMatch ? "" : "none";
            });
        });
    }

    function readFavorites() {
        try {
            const raw = localStorage.getItem(FAVORITES_KEY);
            const parsed = raw ? JSON.parse(raw) : [];
            return new Set(Array.isArray(parsed) ? parsed : []);
        } catch (error) {
            return new Set();
        }
    }

    function writeFavorites(favoritesSet) {
        localStorage.setItem(FAVORITES_KEY, JSON.stringify([...favoritesSet]));
    }

    function initFavorites() {
        const buttons = document.querySelectorAll(".favorite-toggle[data-favorite-id]");
        if (!buttons.length) {
            return;
        }

        const favorites = readFavorites();

        buttons.forEach((button) => {
            const favoriteId = button.getAttribute("data-favorite-id");
            const card = button.closest(".car-selection-container");
            const isFavorite = favorites.has(favoriteId);

            button.setAttribute("aria-pressed", String(isFavorite));
            button.textContent = isFavorite ? "\u2605" : "\u2606";
            if (card) {
                card.classList.toggle("is-favorite", isFavorite);
            }

            button.addEventListener("click", () => {
                const active = favorites.has(favoriteId);
                if (active) {
                    favorites.delete(favoriteId);
                } else {
                    favorites.add(favoriteId);
                }

                writeFavorites(favorites);
                const nowFavorite = !active;
                button.setAttribute("aria-pressed", String(nowFavorite));
                button.textContent = nowFavorite ? "\u2605" : "\u2606";
                if (card) {
                    card.classList.toggle("is-favorite", nowFavorite);
                }
            });
        });
    }

    initDropdowns();
    initSearch();
    initFavorites();
})();
