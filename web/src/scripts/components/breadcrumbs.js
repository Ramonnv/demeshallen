jQuery(document).ready(function ($) {
  if ($(".fairbase-breadcrumbs").length > 0) {
    $(".fairbase-breadcrumbs .breadcrumb").each(function () {
      var $items = $(this).children();
      var count = $items.length;

      if (count > 4) {
        // Show first 2 and last 2
        $items.each(function (index) {
          if (index > 1 && index < count - 2) {
            $(this).hide();
          }
        });

        $("<li>...</li>").insertAfter($items.eq(1));
      }
    });
  }
});
