<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 

document.addEventListener("DOMContentLoaded", function() {
    const productTitles = document.querySelectorAll('.product-title-title');
    
    productTitles.forEach(function(title) {
        title.textContent = title.textContent.toUpperCase();
    });
});
</script>
<!-- end Simple Custom CSS and JS -->
