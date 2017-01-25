/*
 * @auth pengliu186@163.com
 * @desc v1.0
 *
 */
$(document).ready(function() {
    var $BODY = $('body'),
        $MENU_TOGGLE = $('#menu_toggle'),
        $SIDEBAR_MENU = $('#sidebar-menu');

    //sidebar click
    $SIDEBAR_MENU.find('.menu_tile').on('click', function(ev) {
        var $li = $(this).parent();
        if ($li.is('.active')) {
            $li.removeClass('active active-sm');
            $('ul:first', $li).slideUp(function() {});
        } else {
            // prevent closing menu if we are on child menu
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm');
                $SIDEBAR_MENU.find('li ul').slideUp();
            }
            $li.addClass('active');
            $('ul:first', $li).slideDown(function() {});
        }
    });
    // sidebar small
    $MENU_TOGGLE.on('click', function() {
        if ($BODY.hasClass('nav-md')) {
            $SIDEBAR_MENU.find('li.active ul').hide();
            $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
        } else {
            $SIDEBAR_MENU.find('li.active-sm ul').show();
            $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
        }
        $BODY.toggleClass('nav-md nav-sm');
    });
    //tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
    // fixed sidebar
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true,
            theme: 'minimal',
            mouseWheel:{ preventDefault: true }
        });
    }
});




/*******************************************************************************************************************
 *
 * @todo 自定义控件操作
 * @auth eliBool@outlook.com
 *
 */
$(document).ready(function() {
    //sidebar open page with page tabs
    $('.child_menu').on('click','a',function(e){
        e.stopPropagation();
        var $li = $(this).parent();
        if (!$li.hasClass('current-page')) {
            $li.siblings().removeClass('current-page');
            $li.addClass('current-page');
        }
        VT.handle.create({url:$(this).attr('href').substring(1),title:$(this).attr('title')});
    });
    //page switch
    $('#tab_index').on('click','li',function(e){
        e.preventDefault();
        var page_index = $(this).attr('data-page-index');
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('#tab_pages iframe').hide();
        $('#tab_pages #'+page_index).show();
        VT.handle.loadingDone();
    });
    //remove
    $('#tab_index').on('click','.badge',function(e){
        e.stopPropagation();
        var $li = $(this).parent().parent();
        if($li.hasClass('active')){
            if($li.prev().attr('data-page-index'))
            {
                var page_index = $li.prev().attr('data-page-index');
                $li.prev().addClass('active');
            }else{
                var page_index = $li.next().attr('data-page-index');
                $li.next().addClass('active');
            }
            $('#tab_pages').find('#'+page_index).show();
        }
        $('#tab_pages').find('#'+$li.attr('data-page-index')).remove();
        $li.remove();
    });
    //reload
    $('#tab_index').on('click','.active .fa-file-text-o',function(e){
        e.stopPropagation();
        var $li = $(this).parent().parent();
        var page_index = $li.attr('data-page-index');
        $(VT.config.loading_container).show();
        $('#tab_pages').find('#'+page_index).attr('src',$('#'+page_index).attr('src'));
    });
    //son pages open in parent page tabs
    $('.open-page-tab').on('click',function(e){
        if(window.parent.VT.config.index_num > 1)
        {
            e.preventDefault();
            window.parent.VT.handle.create({url:$(this).attr('href'),title:$(this).attr('title')});
            return;
        }
    });
});
// NProgress
if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        if(window.parent.VT)
            window.parent.VT.handle.loadingDone();
        NProgress.start();
    });
    $(window).load(function () {
        NProgress.done();
    });
}


/*
 * @todo 自定义 table and page
 */
var  VT = window.VT || {};
VT.config = {
    index_num:1,
    index_container : '#tab_index',
    page_container:'#tab_pages',
    loading_container:'#tab_pages .loading-container'
};
VT.handle = {
    create :function(options){
        var self = {};
        self.url = options.url;
        self.title = options.title || 'new page '+VT.config.index_num;

        var index_html = '<li class="active" data-page-index="page_table_'+VT.config.index_num+'"><a href="javascript:;" class="info-number">'+
            '<i class="fa fa-file-text-o"></i> '+self.title+
            '<span class="badge bg-green">X</span>'+
            '</a></li>';
        var page_html = ' <iframe id="page_table_'+VT.config.index_num+'" frameborder="0" width="100%" height="100%" src="'+self.url+'" ></iframe>';
        if(self.url.indexOf('http:') === -1){
            $(VT.config.loading_container).show();
        }
        $(VT.config.index_container).find('li').removeClass('active');
        $(VT.config.index_container).append(index_html);
        $(VT.config.page_container).find('iframe').hide();
        $(VT.config.page_container).append(page_html);
        VT.config.index_num += 1;
    },
    loadingDone:function(){
        $(VT.config.loading_container).hide();
    }
};
/*
 * @todo 自定义modal
 */
var Ga = window.Ga || {};
Ga.dialog = {
    timeout: 2,
    /*
     * @params level  1 or 0 ; 0 提示级弹出框,1 from类弹框
     */
    show: function(message, title, level) {
        title = title || '系统提示';
        level = level || 0;
        message = (level == 1 && message.length > 0) ? message : '<p>' + message + '</p>';
        var strHtml = [
            '<div class="modal fade" id="notifyModal" tabindex="-1" role="dialog" aria-labelledby="notifyModalLabel" aria-hidden="true">',
            '<div class="modal-dialog' + (level == 1 ? ' modal-lg' : ' modal-sm') + '">',
            '<div class="modal-content">',
                '<div class="modal-header">',
                    '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>',
                    '<h4 class="modal-title" id="notifyModalLabel">' + title + '</h4>',
                '</div>'
        ].join('');
        if (level == 1) {
            strHtml += message;
        } else {
            strHtml += [
                '<div class="modal-body">',
                    message,
                '</div>'
            ].join('');
            strHtml += [
                '<div class="modal-footer">',
                    '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>',
                    '<button type="button" class="btn btn-primary sub" data-loading-text="Loading...">确定</button>',
                '</div>'
            ].join('');
        }
        strHtml += [
            '</div>',
            '</div>',
            '</div>'
        ].join('');
        this.remove();
        $('body').prepend(strHtml);
        $('#notifyModal').modal('show');
        $('#notifyModal').on('hide.bs.modal',function(e){
            setTimeout(Ga.dialog.remove,500);
        });
    },
    remove: function() {
        $('#notifyModal').remove();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    }
};
Ga.handle = {
    remove:function(options){
        var msg = options.msg,
            title = options.title || '',
            url = options.url,
            data = options.data;
        Ga.dialog.show(msg,title,0);
        $('#notifyModal').on('click','.sub',function(e){
            $(this).button('loading');
            url += '?'+data;
            window.location.href = url;
        });
    }
};