// Get all the img elements
const imgs = document.querySelectorAll('.author-list-widget li img');

// Add event listeners for each img
imgs.forEach(img => {
  img.addEventListener('mouseover', function() {
    this.style.borderRadius = '20%'; // Change border radius on hover
  });

  img.addEventListener('mouseout', function() {
    this.style.borderRadius = '50%'; // Reset border radius on mouseout
  });
});
