// 文件上传
jQuery(function() {
    var $ = jQuery,
        $list = $('#thelist'),
        $btn = $('#ctlBtn'),
        state = 'pending',
        uploader;

    var server = $('input#action').val();
    var froot = $('input#froot').val();
    uploader = WebUploader.create({

        // 不压缩image
        resize: false,

        // swf文件路径
        swf: froot + '/Admin/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: server,

        chunked:true,
        // 分片大小
        chunkSize:20 *1024 * 1024,   //20M
        //最大上传的文件数量, 总文件大小,单个文件大小(单位字节);
        fileNumLimit:1,
        fileSizeLimit:1000 * 1024 * 1024, //1G
        fileSingleSizeLimit:1000 * 1024 * 1024,  //1G

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#picker',

        //只允许选择图片
        accept: {
           title: 'Video',
           extensions: 'mp4',
            mineTypes:'video/mp4'
        },
        duplicate :false //防止多次上传
    });

    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        $list.append( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">等待上传...</p>' +
            '</div>' );
    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress .progress-bar');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<div class="progress progress-striped active">' +
                '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                '</div>' +
                '</div>').appendTo( $li ).find('.progress-bar');
        }

        $li.find('p.state').text('上传中');

        $percent.css( 'width', percentage * 100 + '%' );
        $percent.css( 'height',  '10px' );
        $percent.css( 'margin-bottom',  '20px' );
    });

    uploader.on( 'uploadSuccess', function( file , response) {
        var fileinfojson =response._raw;//上传图片路径
        var obj = new Function("return" + fileinfojson)();//转换后的JSON对象
        var fileurl = obj.oldName;
        $('input#videourl').val(fileurl);
        $( '#'+file.id ).find('p.state').text('已上传');
    });

    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传出错');
    });

    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').fadeOut();
    });

    uploader.on( 'all', function( type ) {
        if ( type === 'startUpload' ) {
            state = 'uploading';
        } else if ( type === 'stopUpload' ) {
            state = 'paused';
        } else if ( type === 'uploadFinished' ) {
            state = 'done';
        }

        if ( state === 'uploading' ) {
            $btn.text('等待上传...');
        } else {
            //$btn.text('开始上传');
        }
    });

    $btn.on( 'click', function() {
        if ( state === 'uploading' ) {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });


});
