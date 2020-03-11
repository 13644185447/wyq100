<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('merch/manage/_header_base', TEMPLATE_INCLUDEPATH)) : (include template('merch/manage/_header_base', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    html{height: 100%;}
    body.signin {
        background: #efefef;
        height: auto;

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        color:#666;
    }

    .signin .signhead {
        width: 750px;
        text-align: center;
    }
    .signinpanel {
        width: 750px;
        margin: 10% auto 0 auto;
    }
    .signinpanel .signin-info   {
        padding: 0;
        margin-top:5px;
    }
    .signinpanel .signin-info img {
        width:400px;height:260px;
    }
    .signinpanel .form-control {
        display: block;
        margin-top: 15px;
    }

    .signinpanel .btn {
        margin-top: 15px;
    }

    .signinpanel form {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255,255,255,.3);
        -moz-box-shadow: 0 3px 0 rgba(12, 12, 12, 0.03);
        -webkit-box-shadow: 0 3px 0 rgba(12, 12, 12, 0.03);
        box-shadow: 0 3px 0 rgba(12, 12, 12, 0.03);
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        padding: 30px;
    }

    .signup-footer{border-top: solid 1px rgba(255,255,255,.3);margin:20px 0;padding-top: 15px;}

    @media screen and (max-width: 768px) {
        .signinpanel,
        .signuppanel {
            margin: 0 auto;
            width: 420px!important;
            padding: 20px;
        }
        .signinpanel form {
            margin-top: 20px;
        }
        .signup-footer {
            margin-bottom: 10px;
        }
        .signuppanel .form-control {
            margin-bottom: 10px;
        }
        .signup-footer .pull-left,
        .signup-footer .pull-right {
            float: none !important;
            text-align: center;
        }
        .signinpanel .signin-info ul {
            display: none;
        }
    }
    @media screen and (max-width: 320px) {
        .signinpanel,
        .signuppanel {
            margin:0 20px;
            width:auto;
        }
    }

</style>
<body class="signin">

<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <img src="<?php  if(empty($set['regpic'])) { ?>../addons/ewei_shopv2/plugin/merch/template/mobile/default/static/images/regbg.png<?php  } else { ?><?php  echo $set['regpic']?><?php  } ?>" />
            </div>
        </div>
        <div class="col-sm-5">
            <form method="post">
                <h4 class="no-margins">商家登录</h4>
                <p class="m-t-md">登录到商户管理后台</p>

                <input type="text" class="form-control" placeholder="用户名" name="username"  />
                <input type="password" class="form-control m-b" placeholder="密码" name="pwd" />
                <p class="help-block text-danger" id="tip" style="display:none;"></p>
                <button type="submit" id="btn-login" class="btn btn-primary btn-block">登录</button>
            </form>
        </div>
    </div>
</div>
</div>
<script language='javascript'>
            $('form').submit(function (e) {
                e.preventDefault();
                if ($(":input[name=username]").isEmpty()) {
                    $('#tip').html('请输入用户名!').show();
                    $(":input[name=username]").focus();
                    return;
                } else{
                    $('#tip').hide();
                }
                if ($(":input[name=pwd]").isEmpty()) {
                    $('#tip').html('请输入密码!').show();
                    $(":input[name=pwd]").focus();
                    return;
                } else{
                    $('#tip').hide();
                }
                if($(this).attr('stop')){
                    return;
                }

                $('#btn-login').attr('stop',1).html('正在登录...');
                $.ajax({
                    url: "<?php  echo $submitUrl;?>",
                    type:'post',
                    data: {username: $(":input[name=username]").val() ,pwd: $(":input[name=pwd]").val() },
                    dataType:'json',
                    cache:false,
                    success:function(ret){
                        if(ret.status==1){
                             location.href = ret.result.url;
                             return;
                        }
                        $('#btn-login').removeAttr('stop').html('登录');
                        $(":input[name=pwd]").select();
                        $('#tip').html(ret.result.message).show();
                    }
                })
            })
</script>
<script language="javascript">myrequire(['web/init'],function(){});</script>
<?php  if(!empty($_W['setting']['copyright']['statcode'])) { ?><?php  echo $_W['setting']['copyright']['statcode'];?><?php  } ?>
<?php  if(!empty($copyright) && !empty($copyright['copyright'])) { ?>

<?php  } ?>
</body>
</html>