(function ($) {
 
    parent.document.addEventListener("mousedown", function (e) {
        var widgets = parent.document.querySelectorAll(".elementor-element--promotion");
        if (widgets.length > 0) {
            for (var i = 0; i < widgets.length; i++) {
                if (widgets[i].contains(e.target)) {
                    var dialog = parent.document.querySelector("#elementor-element--promotion__dialog");
                    var icon = widgets[i].querySelector(".icon > i");
                    var widget_title = widgets[i].querySelector(".title-wrapper > .title");
                    if (widget_title.closest('.htmega-promotion-element')) {
                        dialog.classList.add('htmega-pro-widget');
                        dialog.querySelector(".htmega-pro-widget .dialog-buttons-message").innerHTML = 'Use ' + widget_title.innerHTML + '  and access a variety of advanced features to enhance your toolkit and create your website more efficiently and effectively.';
                        if (dialog.querySelector("a.htmega-pro-dialog-buttons-action") === null) {
                            var button = document.createElement("a");
                            var buttonText = document.createTextNode("Upgrade to Pro");
                            button.setAttribute("href", "https://wphtmega.com/pricing/");
                            button.setAttribute("target", "_blank");
                            button.classList.add(
                                "dialog-button",
                                "dialog-action",
                                "dialog-buttons-action",
                                "elementor-button",
                                "elementor-button-success",
                                "htmega-pro-dialog-buttons-action"
                            );
                            button.appendChild(buttonText);
                            dialog.querySelector(".htmega-pro-widget .dialog-buttons-action").insertAdjacentHTML("afterend", button.outerHTML);
                            dialog.querySelector(".elementor-button.go-pro.dialog-buttons-action").classList.add('htmega-elementor-buttion-pro-hide');
                        } else {
                            dialog.querySelector(".elementor-button.go-pro.dialog-buttons-action").classList.add('htmega-elementor-buttion-pro-hide');
                        }
                    } else {
                        dialog.classList.remove('htmega-pro-widget');
                    }
                    break;
                }
            }
        }
    });

})(jQuery);    