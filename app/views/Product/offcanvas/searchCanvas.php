<section class="search-overlay">
    <div class="container search-container">
        <div class="py-5" id="result">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead lh-1 m-0 fw-bold"><?= __('What are you looking for?') ?></p>
                <button class="btn btn-light btn-close-search"><i class="ri-close-circle-line align-bottom"></i><?= __('Close search') ?></button>
            </div>
            <form>
                <input type="text" class="form-control" id="searchForm" placeholder="<?= __('Search by product name...') ?>" oninput="userType()">
            </form>
            <div class="my-5">
                <div class="row" id="searchResult">
                </div>
            </div>

            <div class="bg-dark p-4 text-white">
                <p class="lead m-0"> <?= __("Didn't find what you are looking for?") ?> <a class="transition-all opacity-50-hover text-white text-link-border border-white pb-1 border-2" href="/Contact/Contact_us"><?= __('Send us a message.') ?></a></p>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function userType() {
        var searchTerm = $('#searchForm').val(); // Get the value of the search input
        // Make an AJAX request to your PHP controller
        $.ajax({
            type: 'POST', // Use POST method
            url: '/Product/testAjax', // Replace 'your_php_controller_url_here.php' with the actual URL of your PHP controller
            data: {
                searchTerm: searchTerm
            }, // Send the search term as data
            success: function(response) { // Handle the successful response
                $('#searchResult').html(response); // Replace the content of the 'result' element with the response from the server
            }
        });
    }
</script>