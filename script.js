document.addEventListener('DOMContentLoaded', () => {
  // Smooth scroll to menu section
  const menuLink = document.querySelectorAll('.nav-link')[1];
  const menuSection = document.getElementById('menu-section');

  if (menuLink && menuSection) {
    menuLink.addEventListener('click', (event) => {
      event.preventDefault();
      menuSection.scrollIntoView({ behavior: 'smooth' });
    });
  }

  // Gallery filter logic
  const filterButtons = document.querySelectorAll('.gallery-filters button');
  const galleryImages = document.querySelectorAll('.gallery-grid img');

  if (filterButtons.length && galleryImages.length) {
    filterButtons.forEach((button) => {
      button.addEventListener('click', () => {
        // Update active button styling
        filterButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const selectedCategory = button.getAttribute('data-category');

        galleryImages.forEach((img) => {
          const imgCategory = img.dataset.category;
          img.style.display =
            selectedCategory === 'all' || imgCategory === selectedCategory
              ? 'block'
              : 'none';
        });
      });
    });
  }
});
