<script>
    $(document).ready(function() {
        // Get the modal, modal image and close button
        var $modal = $('#myModal');
        var $modalImg = $('#modalImg');
        var $closeBtn = $('.close');

        // Function to open the modal with the clicked image
        function openModal(event) {
            var src = $(event.target).attr('src');
            $modalImg.attr('src', src);
            $modal.show();
        }

        // Function to close the modal
        function closeModal() {
            $modal.hide();
        }

        // Add click event listener to all images on the page
        $('img').on('click', openModal);

        // Add click event listener to the close button
        $closeBtn.on('click', closeModal);

        // Add click event listener to close the modal when clicking outside of the image
        $(window).on('click', function(event) {
            if ($(event.target).is($modal)) {
                closeModal();
            }
        });
    });
</script>
