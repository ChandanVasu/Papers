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



// // Get all <p> elements inside .author-list-widget
// var paragraphs = document.querySelectorAll('.author-list-widget li p');

// // Define the maximum length for the content
// var maxLength = 1;

// // Iterate over each <p> element
// paragraphs.forEach(function(paragraph) {
//     // Get the text content of the paragraph
//     var text = paragraph.textContent.trim();

//     // Trim the text content if it exceeds the maximum length
//     if (text.length > maxLength) {
//         text = text.substring(0, maxLength) + '...'; // Append ellipsis
//     }

//     // Update the text content of the paragraph
//     paragraph.textContent = text;
// });
