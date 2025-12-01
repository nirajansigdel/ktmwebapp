<style>
    /* Contact-style dark panel styles for blog items */
    .contact-panel {
        background: #0b2f63; /* deep navy */
        color: #e6eef9;
        padding: 3rem 1rem;
        min-height: 320px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: 0;
    }

    .contact-panel h3 {
        font-family: 'Playfair Display', serif;
        color: #d2dbe8;
        font-size: 2.6rem;
        line-height: 1.05;
        margin-bottom: 1rem;
    }

    .contact-panel p { color: #f3f7fb; margin-bottom: 1rem; }

    .contact-panel .contact-list { color: #dbe7fb; margin: 1rem 0 1.5rem; }

    .contact-cta {
        background: #ffffff;
        color: #0b2f63;
        padding: 0.9rem 1.4rem;
        display: inline-block;
        font-weight: 700;
        border-radius: 2px;
        text-decoration: none;
        box-shadow: none;
        width: fit-content;
    }

    /* Keep previous slide-in classes but slightly slower for this layout */
    .slide-in-left { opacity: 0; transform: translateX(-40px); animation: slideInLeft .9s forwards; }
    .slide-in-right { opacity: 0; transform: translateX(40px); animation: slideInRight .9s forwards; }
    @keyframes slideInLeft { to { opacity: 1; transform: translateX(0); } }
    @keyframes slideInRight { to { opacity: 1; transform: translateX(0); } }

    /* Make the image fill height of panel on large screens */
    .blog-image { width: 100%; height:86.5vh; object-fit: cover; border-radius: 0; }

    @media (max-width: 991.98px) {
        .contact-panel { padding: 2rem; }
        .contact-panel h3 { font-size: 1.6rem; }
        .blog-image { height: auto; }
    }
</style>