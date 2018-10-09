require('./bootstrap');

var Selector = {
    contentWrapper: '.content-wrapper',
    navTabs: '.MA_tabs .nav-tabs',
    navContent: '.MA_tabs .tab-content',
    menu: '.MA_menu'
};

$('a:not([href="#"])', $(Selector.menu)).click(function (e) {
    e.preventDefault();

    $('.active', $(Selector.menu)).removeClass('active');
    $(this).parent('li').addClass('active').closest('.treeview').addClass('active');
});

$(document).on('click', '[ma-tab]', function (e) {
    e.preventDefault();
    var $this = $(this);
    var tabText = $this.attr('ma-tab');
    var tabName = '#MA_tab_' + md5($this.prop('href'));

    if (!$('a[href="' + tabName + '"]', $(Selector.navTabs, _document)).length) {
        var $li = $('<li/>').appendTo($(Selector.navTabs, _document));
        var $a = $('<a/>', {
            href: tabName
        }).attr('data-toggle', 'tab')
            .append($('<span/>', {text: tabText})).appendTo($li);
        var $overlay = $('<div/>').addClass('overlay').appendTo($li);
        var $wrap = $('<div/>').addClass('wrap').appendTo($overlay);
        $('<i/>').attr('data-widget', 'refresh').addClass('fa fa-repeat').appendTo($wrap);
        $('<i/>').attr('data-widget', 'close').addClass('fa fa-close').appendTo($wrap);

        var $div = $('<div/>').addClass('tab-pane').prop('id', tabName.slice(1)).appendTo($(Selector.navContent, _document));
        var $iframe = $('<iframe/>', {src: $this.prop('href')}).appendTo($div);
    } else {
        $a = $('a[href="' + tabName + '"]', $(Selector.navTabs, _document));
    }

    $('a[href="' + tabName + '"]', $(Selector.navTabs, _document)).parent('li').addClass('active').siblings().removeClass('active');
    $(tabName, $(Selector.navContent, _document)).addClass('active').siblings().removeClass('active');
});

$(Selector.navTabs, document).on('click', 'i', function (e) {
    var $this = $(this);
    var $parent = $this.closest('li');
    var $a = $parent.find('a');
    var $tab = $(URI($a.prop('href')).hash(), $(Selector.navContent, _document));

    if ($this.data('widget') == 'refresh') {
        $('iframe', $tab)[0].contentDocument.location.reload();
    }
    if ($this.data('widget') == 'close') {
        $tab.remove();
        $parent.remove();

        if (!$('li.active', $(Selector.navTabs, _document)).length) {
            $('a:last', $(Selector.navTabs, _document)).tab('show');
        }
    }

});