<script>
  function isTouchEnabled() {
  return (("ontouchstart" in window)
    || (navigator.MaxTouchPoints > 0)
    || (navigator.msMaxTouchPoints > 0));
}
jQuery(function () {
  jQuery("path[id^=trjs]").each(function (i, e) {
    traddEvent( jQuery(e).attr("id"));
  });
});
function traddEvent(id,relationId) {
  var _obj = jQuery("#" + id);
  var arr = id.split("");
  var _Textobj = jQuery("#" + id + "," + "#trjsvn" + arr.slice(4).join(""));
  jQuery("#" + ["visnames"]).attr({"fill":trjsconfig.general.visibleNames});
  _obj.attr({"fill":trjsconfig[id].upColor, "stroke":trjsconfig.general.borderColor});
  _Textobj.attr({"cursor": "default"});
  if (trjsconfig[id].active === true) {
    _Textobj.attr({"cursor": "pointer"});
    _Textobj.hover(function () {
      jQuery("#trjstip").show().html(trjsconfig[id].hover);
      _obj.css({"fill":trjsconfig[id].overColor});
    }, function () {
      jQuery("#trjstip").hide();
      jQuery("#" + id).css({"fill":trjsconfig[id].upColor});
    });
    if (trjsconfig[id].target !== "none") {
      _Textobj.mousedown(function () {
        jQuery("#" + id).css({"fill":trjsconfig[id].downColor});
      });
    }
    _Textobj.mouseup(function () {
      jQuery("#" + id).css({"fill":trjsconfig[id].overColor});
      if (trjsconfig[id].target === "new_window") {
        window.open(trjsconfig[id].url);	
      } else if (trjsconfig[id].target === "same_window") {
        window.parent.location.href = trjsconfig[id].url;
      } else if (trjsconfig[id].target === "modal") {
        jQuery(trjsconfig[id].url).modal("show");
      }
    });
    _Textobj.mousemove(function (e) {
      var x = e.pageX + 10, y = e.pageY + 15;
      var tipw =jQuery("#trjstip").outerWidth(), tiph =jQuery("#trjstip").outerHeight(),
      x = (x + tipw >jQuery(document).scrollLeft() +jQuery(window).width())? x - tipw - (20 * 2) : x ;
      y = (y + tiph >jQuery(document).scrollTop() +jQuery(window).height())? jQuery(document).scrollTop() +jQuery(window).height() - tiph - 10 : y ;
      jQuery("#trjstip").css({left: x, top: y});
    });
    if (isTouchEnabled()) {
      _Textobj.on("touchstart", function (e) {
        var touch = e.originalEvent.touches[0];
        var x = touch.pageX + 10, y = touch.pageY + 15;
        var tipw =jQuery("#trjstip").outerWidth(), tiph =jQuery("#trjstip").outerHeight(),
        x = (x + tipw >jQuery(document).scrollLeft() +jQuery(window).width())? x - tipw -(20 * 2) : x ;
        y =(y + tiph >jQuery(document).scrollTop() +jQuery(window).height())? jQuery(document).scrollTop() +jQuery(window).height() -tiph - 10 : y ;
        jQuery("#" + id).css({"fill":trjsconfig[id].downColor});
        jQuery("#trjstip").show().html(trjsconfig[id].hover);
        jQuery("#trjstip").css({left: x, top: y});
      });
      _Textobj.on("touchend", function () {
        jQuery("#" + id).css({"fill":trjsconfig[id].upColor});
        if (trjsconfig[id].target === "new_window") {
          window.open(trjsconfig[id].url);
        } else if (trjsconfig[id].target === "same_window") {
          window.parent.location.href = trjsconfig[id].url;
        } else if (trjsconfig[id].target === "modal") {
          jQuery(trjsconfig[id].url).modal("show");
        }
      });
    }
	}
}
  </script>