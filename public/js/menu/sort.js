$(document).ready(function () {
  $("#sort-dropdown").on("change", function () {
    let sortValue = $(this).val();
    loadAjaxMenu(1, sortValue); // Return to page 1
  });

  // Click to switch pages
  $(document).on("click", ".custom-pagination .page-link", function (e) {
    e.preventDefault();

    let urlParams = new URLSearchParams($(this).attr("href").split("?")[1]);
    let pageNumber = urlParams.get("p");
    let sortValue = $("#sort-dropdown").val();

    if (pageNumber) {
      loadAjaxMenu(pageNumber, sortValue);
    }
  });

  // AJAX
  function loadAjaxMenu(page, sort) {
    // Blur to indicate loading
    $("#ajax-product-container").css("opacity", "0.5");

    $.ajax({
      url: "index.php",
      type: "GET",
      data: {
        page: "product_sort",
        p: page,
        sort: sort,
      },
      success: function (response) {
        // Insert new HTML into the frame
        $("#ajax-product-container").html(response);
        $("#ajax-product-container").css("opacity", "1");

        let newUrl = "?page=home&p=" + page + "&sort=" + sort;
        window.history.pushState(null, "", newUrl);
      },
      error: function () {
        alert("Error loading page!");
        $("#ajax-product-container").css("opacity", "1");
      },
    });
  }
});
