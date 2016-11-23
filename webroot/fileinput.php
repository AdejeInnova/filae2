<!DOCTYPE html>
<!-- release v4.3.6, copyright 2014 - 2016 Kartik Visweswaran -->
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Krajee JQuery Plugins - &copy; Kartik</title>
        <!--link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"-->
        <link rel="stylesheet" href="/filae2/admin_l_t_e/bootstrap/css/bootstrap.css"/>


        <!-- OTROS CSS CARGADOS-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/filae2/admin_l_t_e/css/AdminLTE.min.css"/><!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/filae2/admin_l_t_e/css/skins/skin-blue.css"/>
        <link rel="stylesheet" href="/filae2/admin_l_t_e/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"/>

        <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

        <script src="/filae2/admin_l_t_e/plugins/jQuery/jQuery-2.1.4.min.js"></script><!-- Bootstrap 3.3.5 -->
        <script src="/filae2/admin_l_t_e/bootstrap/js/bootstrap.js"></script><!-- SlimScroll -->
        <script src="/filae2/admin_l_t_e/plugins/slimScroll/jquery.slimscroll.min.js"></script><!-- FastClick -->
        <script src="/filae2/admin_l_t_e/plugins/fastclick/fastclick.js"></script><!-- AdminLTE App -->
        <script src="/filae2/admin_l_t_e/js/AdminLTE.min.js"></script><!-- AdminLTE for demo purposes -->

        <!-- plugin wysihtml5 -->
        <script src="/filae2/admin_l_t_e/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

        <script src="js/fileinput.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container kv-main">
            <form enctype="multipart/form-data">
                <div class="form-group">
                    <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
                </div>
            </form>
        </div>
    </body>
	<script>

    $("#file-1").fileinput({
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions : ['jpg', 'png','gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
	});


	</script>
</html>