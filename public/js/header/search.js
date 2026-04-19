$(function () {
  const $searchInput = $("#ajaxSearch");
  const $searchResults = $("#searchResults");
  let timeoutId;

  $searchInput.on("input", function () {
    const query = $(this).val().trim();
    clearTimeout(timeoutId);

    if (query.length > 0) {
      // Debounce: Đợi 300ms sau khi ngừng gõ
      timeoutId = setTimeout(() => {
        $.getJSON(`index.php?page=product_search`, { query: query })
          .done(function (data) {
            $searchResults.empty().removeClass("d-none");

            if (data.length > 0) {
              $.each(data, function (i, item) {
                const imgPath = `/restaurant_project/public/images/${item.category_slug}/${item.image_url}`;
                $searchResults.append(`
                  <a
                    href="index.php?page=detail&slug=${item.slug}"
                    class="dropdown-item d-flex align-items-center py-1">
                      <img src="${imgPath}"
                      alt="${item.name}"
                      class="rounded ms-3 shadow-sm"
                      style="width: 60px; height: 60px; object-fit: cover">
                      <div class="ms-3 d-flex flex-column justify-content-between align-items-start">
                        <h1 class="fw-bold text-dark mt-1 mb-0 text-truncate" style="font-size: 1.25rem; line-height: 1.75rem;">${item.name}</h1>
                        <p class="fw-semibold text-primary-orange mb-0" style="font-size: 1rem; line-height: 1.5rem;">${item.price}đ</p>
                      </div>
                  </a>
                `);
              });
            } else {
              $searchResults.html(
                '<div class="p-3 text-muted text-center small">No matching dishes found.</div>',
              );
            }
          })
          .fail(function () {
            $searchResults
              .html(
                '<p class="p-3 text-danger text-center small">Error loading results.</p>',
              )
              .removeClass("d-none");
          });
      }, 300);
    } else {
      $searchResults.addClass("d-none").empty();
    }
  });

  // UX: Click ra ngoài thì ẩn kết quả
  $(document).on("click", function (e) {
    if (
      !$searchInput.is(e.target) &&
      !$searchResults.is(e.target) &&
      $searchResults.has(e.target).length === 0
    ) {
      $searchResults.addClass("d-none");
    }
  });

  // UX: Hiện lại kết quả khi focus lại ô input
  $searchInput.on("focus", function () {
    if (
      $(this).val().trim().length > 0 &&
      $searchResults.children().length > 0
    ) {
      $searchResults.removeClass("d-none");
    }
  });
});
