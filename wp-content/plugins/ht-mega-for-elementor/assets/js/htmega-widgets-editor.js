;(function($){

    // To dynamic load css in panel view
      elementor.hooks.addFilter( 'editor/style/styleText', function( css, context ) {
  
          if (!context) { return; }
  
          var model = context.model,
              generatedCss = model.get('settings').get('htmega_custom_css');
          var selector = '.elementor-element.elementor-element-' + model.get('id');
          
          if ( 'document' === model.get('elType') ) {
              selector = elementor.config.document.settings.cssWrapperSelector;
          }
  
          if ( generatedCss ) {
              css += generatedCss.replace(/selector/g, selector);
          }
  
          return css;
      });
  
      elementor.hooks.addFilter("panel/elements/regionViews", function (panel) {
  
   if ( htmegaPanelSettings.htmega_pro_installed || _.isEmpty( htmegaPanelSettings.htmega_pro_widgets ) ) return panel;
   
          var proCategoryIndex,
              elementsView = panel.elements.view,
              categoriesView = panel.categories.view,
              widgets = panel.elements.options.collection,
              categories = panel.categories.options.collection,
              htmegaPorcategroy = [];
          return (
          _.each(htmegaPanelSettings.htmega_pro_widgets, function (widget, index) {
              widgets.add({
                  name: widget.key,
                  //title: wp.i18n.__('HTMega Pro ', 'htmega-addons') + widget.title,
                  title: widget.title,
                  icon: widget.icon,
                  categories: ["htmega-pro-addons"],
                  editable: !1
              })
          }),
  
          widgets.each(function (widget) {
              "htmega-pro-addons" === widget.get("categories")[0] && htmegaPorcategroy.push(widget)
          }),
  
          (proCategoryIndex = categories.findIndex({
              name: "htmega-addons"
          })),
  
          ( proCategoryIndex && categories.add({
              name: "htmega-pro-addons",
              title: "HTMega Pro Addons",
              defaultActive: 1,
              sort: !0, 
              hideIfEmpty: !0, 
              items: htmegaPorcategroy,
              promotion: !1
          }, {
              at: proCategoryIndex + 1
          })),
  
          ( panel.elements.view = elementsView.extend({
              childView: elementsView.prototype.childView.extend(  categories = {
                  className: function () {
      
                      var className = 'elementor-element-wrapper';
      
                      if (!this.isEditable()) {
                          className += ' elementor-element--promotion';
                      }
      
                      if (this.model.get("name")) {
                          if (0 === this.model.get("name").indexOf("htmega-"))
                              className += ' htmega-promotion-element';
                      }
      
                      return className;
      
                  },
       
                  isHTMegaWidget: function () {
  
                      var hasWidget = this.model.get("name");
                      return null != hasWidget && 0 === hasWidget.indexOf("htmega-");
  
                  },
      
                  getElementObj: function (key) {
      
                      var widgetObj = htmegaPanelSettings.htmega_pro_widgets.find(function (widget, index) {
                          if (widget.key == key)
                              return true;
                      });
      
                      return widgetObj;
      
                  },
              }
          )
          })),
  
          ( panel.categories.view = categoriesView.extend({
              childView: categoriesView.prototype.childView.extend({
                  childView: categoriesView.prototype.childView.prototype.childView.extend(categories)
              })
          })),
          panel
          );
  
      });
  
  
  })(jQuery);