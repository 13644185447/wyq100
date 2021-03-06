<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($_GPC['step'] == 1 || $_GPC['step'] == '') { ?>
	<div class="account-list-add" id="js-account-post-step1" ng-controller="AccountPostStepOne" ng-cloak>
		<ol class="breadcrumb we7-breadcrumb">
			<a href="<?php  echo url('account/manage')?>"><i class="wi wi-back-circle"></i></a>
			<li><a href="<?php  echo url('account/manage')?>">平台列表</a></li>
			<li>新建公众号</li>
		</ol>
		<div class="panel we7-panel">
			<div class="panel-body we7-padding">
				<div class="col-lg-6">
					<div class="title">
						<span class="img img-pen"></span>
						<a href="javascript:;">手动添加公众号</a>
					</div>
					<div class="con">
						通过<a href="https://mp.weixin.qq.com/" target="_blank" class="color-default">微信公众平台</a> 基本配置获取AppID和AppSecret，添加成功后，将本平台获取的服务器配置接口绑定到微信公众平台（注：添加过程中，请务必保持参数一致）
					</div>
					<div>
						<a href="<?php  echo url('account/create', array('sign' => 'account'))?>" class="btn btn-primary">手动添加公众号</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="title">
						<span class="img img-tel"></span>
						授权添加公众号
					</div>
					<div class="con">
						<?php  if(user_is_founder($_W['uid'], true)) { ?>
						使用授权添加需认证微信开放平台和全网发布，并在<a href="<?php  echo url('system/platform')?>" target="_blank" class="color-default">微信开放平台设置</a>中启用
						<?php  } else { ?>
						使用公众平台绑定的管理员个人微信扫码即可快速添加
						<?php  } ?>
					</div>
					<div>
						<a href="<?php  echo $authurl;?>" class="btn btn-primary">授权添加公众号</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		angular.module('accountApp').value('config', {});
		angular.bootstrap($('#js-account-post-step1'),['accountApp']);
	</script>
<?php  } else if($_GPC['step'] == 2) { ?>
	<div class="account-list-add-step">
		<ol class="breadcrumb we7-breadcrumb">
			<a href="<?php  echo url('account/manage')?>"><i class="wi wi-back-circle"></i> </a>
			<li><a href="<?php  echo url('account/manage')?>">平台列表</a></li>
			<li>新建公众号</li>
		</ol>
		<ul class="we7-step">
			<li class="new active"><span class="content">1. 设置公众号信息</span></li>
			<?php  if(!empty($_W['isfounder'])) { ?>
			<li><span class="content">2. 设置权限</span></li>
			<li><span class="content">3. 引导页面</span></li>
			<?php  } else { ?>
			<li><span class="content">2. 引导页面</span></li>
			<?php  } ?>
		</ul>
		<form action="" method="post" class="we7-form" enctype="multipart/form-data" id="js-account-post-step2" ng-controller="AccountPostStepTwo" ng-cloak>
			<input type="hidden" name="step" value="2">
			<!--第二步:基本信息-->
			<div class="form-group">
				<label for="" class="control-label col-sm-2">公众号名称</label>
				<div class="form-controls col-sm-8">
					<input type="text" name="cname" class="form-control" ng-model="account.name" autocomplete="off" />
					<span class="help-block">填写公众号的账号名称</span>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">描述</label>
				<div class="form-controls col-sm-8">
					<textarea style="height: 80px;" class="form-control" name="description" ng-bind="account.description"></textarea>
					<span class="help-block">用于说明此公众号的功能及用途。</span>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">公众号账号</label>
				<div class="form-controls col-sm-8">
					<input type="text" name="account" class="form-control" ng-model="account.account" autocomplete="off" />
					<span class="help-block">填写公众号的账号,一般为英文账号</span>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">原始ID</label>
				<div class="form-controls col-sm-8">
					<input type="text" name="original" class="form-control" ng-model="account.original" autocomplete="off" />
					<span class="help-block">原始ID不能修改,请谨慎填写</span>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">类型</label>
				<div class="form-controls col-sm-8">
					<select name="level" class="we7-select">
						<option value="1" ng-selected="account.level == 1">普通订阅号</option>
						<option value="2" ng-selected="account.level == 2">普通服务号</option>
						<option value="3" ng-selected="account.level == 3">认证订阅号</option>
						<option value="4" ng-selected="account.level == 4">认证服务号/认证媒体/政府订阅号</option>
					</select>
					<span class="help-block">注意:即使公众平台显示为“未认证”, 但只要【公众号设置】/【账号详情】下【认证情况】显示资质审核通过, 即可认定为认证号.</span>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">AppId</label>
				<div class="form-controls col-sm-8">
					<input type="text" name="key" class="form-control" ng-model="account.key" autocomplete="off"/>
					<span class="help-block">请填写微信公众平台后台的AppId</span>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">AppSecret</label>
				<div class="form-controls col-sm-8">
					<input type="text" name="secret" class="form-control" ng-model="account.secret" autocomplete="off"/>
					<span class="help-block">请填写微信公众平台后台的AppSecret</span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Oauth 2.0</label>
				<div class="form-controls col-sm-8">
					<p class="form-control-static">在微信公众号请求用户网页授权之前，开发者需要先到公众平台网站的【开发者中心】<b>网页服务</b>中配置授权回调域名。<?php  if($_W['isfounder']) { ?><?php  } ?></p>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">头像</label>
				<div class="form-controls col-sm-8">
					<div class="input-more we7-input-img" ng-class="{'active': account.headimg}">
						<img ng-src="{{account.headimg}}" width="150px" ng-if="account.headimg" ng-style="{'height': 'auto'}">
						<a href="javascript:;" class="input-addon" ng-click="uploadMultiImage('headimg')" ng-hide="account.headimg"><span>+</span></a>
						<input type="text" name="headimg" ng-model="account.headimg" ng-style="{'display' : 'none'}">
						<div class="cover-dark">
							<a href="javascript:;" class="cut" ng-click="uploadMultiImage('headimg')">更换</a>
							<a href="javascript:;" class="del" ng-click="delMultiImage('headimg')"><i class="fa fa-times text-danger"></i></a>
						</div>
					</div>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">二维码</label>
				<div class="form-controls col-sm-8">
					<div class="input-more we7-input-img" ng-class="{'active': account.qrcode}">
						<img ng-src="{{account.qrcode}}" width="150px" ng-if="account.qrcode" ng-style="{'height': 'auto'}">
						<a href="javascript:;" class="input-addon" ng-click="uploadMultiImage('qrcode')" ng-hide="account.qrcode"><span>+</span></a>
						<input type="text" name="qrcode" ng-model="account.qrcode" ng-style="{'display' : 'none'}">
						<div class="cover-dark">
							<a href="javascript:;" class="cut" ng-click="uploadMultiImage('qrcode')">更换</a>
							<a href="javascript:;" class="del" ng-click="delMultiImage('qrcode')"><i class="fa fa-times text-danger"></i></a>
						</div>
					</div>
					<span class="help-block"></span>
				</div>
			</div>
			<div class="form-group col-sm-offset-2">
				<input type="submit" name="submit" class="btn btn-primary btn-submit" value="下一步"/>
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
			</div>
		</form>
	</div>
	<script type="text/javascript">
		angular.module('accountApp').value('config', {

		});
		angular.bootstrap($('#js-account-post-step2'),['accountApp']);
	</script>
<?php  } else if($_GPC['step'] == 3) { ?>
	<div class="account-list-add-step">
		<ol class="breadcrumb we7-breadcrumb">
			<a href="<?php  echo url('account/manage', array('account_type' => ACCOUNT_TYPE_OFFCIAL_NORMAL))?>"><i class="wi wi-back-circle"></i> </a>
			<li><a href="<?php  echo url('account/manage', array('account_type' => ACCOUNT_TYPE_OFFCIAL_NORMAL))?>">公众号列表</a></li>
			<li>新建公众号</li>
		</ol>
		<ul class="we7-step">
			<li ><span class="content">1. 设置公众号信息</span></li>
			<?php  if(!empty($_W['isfounder'])) { ?>
			<li class="active"><span class="content">2. 设置权限</span></li>
			<li><span class="content">3. 引导页面</span></li>
			<?php  } else { ?>
			<li><span class="content">2. 引导页面</span></li>
			<?php  } ?>
		</ul>
		<form action="" method="post" class="we7-form account-create-step" id="js-account-post-step3" ng-controller="AccountPostStepThree" ng-cloak>
			<input type="hidden" name="step" value="3">
			<input type="hidden" name="uniacid" value="<?php  echo $_GPC['uniacid'];?>">
			<input type="hidden" name="acid" value="<?php  echo $_GPC['acid'];?>">
			<!--第三步:设置权限-->
			<div class="we7-page-alert">
				如果不选择主管理员，则默认创始人为该账号的主管理员
			</div>
			<div class="form-group">
				<div class="control-label col-sm-2">主管理员</div>
				<div class="form-controls col-sm-10">
					<div class="input-group">
						<input type="hidden" name="uid" value="<?php  echo $owner['uid'];?>" id="manager">
						<input type="text" class="form-control" value="<?php  echo $owner['username'];?>" ng-model="owner.username" id="showname">
						<span class="input-group-btn">
							<a class="btn btn-default" href="javascript:;" ng-click="selectOwner($event)">选择管理员</a>
						</span>
					</div>
					<span class="help-block">如果是新用户,请先 <a href="<?php  echo url('user/create');?>" target="_blank" class="color-default">添加用户</a></span>
				</div>
			</div>
			<div class="form-group hidden">
				<label for="" class="control-label col-sm-2">修改管理员用户权限组</label>
				<div class="form-controls col-sm-8">
					<select name="groupid" class="select-group col-sm-3" id="groupid" ng-model="owner.groupid" ng-change="changeGroup()">
						<option value="0">不设置</option>
						<?php  if(is_array($groups)) { foreach($groups as $row) { ?>
						<?php $package = iunserializer($row['package']) ? implode(',', iunserializer($row['package'])) : '';?>
						<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $owner['groupid']) { ?>selected<?php  } ?> data-package="[<?php  echo $package;?>]"><?php  echo $row['name'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-sm-2">平台过期时间</label>
				<div class="form-controls col-sm-8">
					<div class="input-group">
						<div ng-bind="owmer"></div>
						<span class="input-group-btn">
							<select name="" class="select-endtime" id="" ng-model="owner.endtime" ng-change="changeEndtime()">
								<option value="1">设置</option>
								<option value="0" >不限</option>
							</select>
						</span>
						<div ng-show="owner.endtime == 1">
							<?php  echo tpl_form_field_date('endtime', $owner['endtime']);?>
						</div>
					</div>
					<span class="help-block">平台有效期默认与主管理员一致，修改日期不可超过主管理员有效期的最大期限。未设置主管理员时，创始人默认为主管理员</span>
				</div>
			</div>
			<div class="col-sm-offset-2 col-sm-8">
				<div class="we7-header" ng-show="owner.username">
					公众号可使用应用/模板权限
				</div>
				<div class="we7-group-show" ng-if="owner.modules">
					<input class="hidden" type="checkbox" name="package[]" checked ng-value="package">
					<div class="name">
						主管理员权限
					</div>
					<div class="group-app-list">
						<div class="group-app-item" ng-repeat="module in owner.modules">
							<img ng-src="{{module.logo}}" class="module-img" alt="">
							<div class="info">
								<div class="title text-over">
									{{module.title}}
								</div>
								<div class="type-list">
									<i class="wi wi-account"></i>
								</div>
							</div>
						</div>
						<div class="group-app-item" ng-if="owner.modules.length < 1">暂无应用</div>
	
						<div class="group-app-item" ng-repeat="module in unigroups[package].templates">
							<img ng-src="{{module.logo}}" class="template-img" alt="">
							<div class="info">
								<div class="title">
									{{module.title}}
								</div>
								<div class="type-list">
									<i class="wi wi-template"></i>
								</div>
							</div>
						</div>
					</div>
					<a class="action"></a>
				</div>
				<div class="we7-header">公众号附加应用权限组</div>
				<div class="we7-group-show " ng-repeat="extend in groupAll.groups" ng-if="extend.checked == 1">
					<input class="hidden" type="checkbox" name="package[]" checked ng-value="extend.id">
					<div class="name">
						{{extend.name}}
					</div>
					<div class="group-app-list">
						<div class="group-app-item" ng-repeat="module in extend.modules_all">
							<img ng-src="{{module.logo}}" class="module-img" alt="">
							<div class="info">
								<div class="title text-over">
									{{module.title}}
								</div>
								<div class="type-list">
									<i ng-class="itme.icon" ng-repeat="itme in module.group_support | moduleInfo" ></i> 
								</div>
							</div>
						</div>
						<div class="group-app-item" ng-repeat="module in extend.templates">
							<img ng-src="{{module.logo}}" class="template-img" alt="">
							<div class="info">
								<div class="title">
									{{module.title}}
								</div>
								<div class="type-list">
									<i class="wi wi-template"></i>
								</div>
							</div>
						</div>
					</div>
					<a class="action"></a>
					<a href="" class="remove" ng-click="extend.checked = 0"><i class="wi wi-error"></i></a>
				</div>
				<we7-modal-app module-list="groupAll" multiple="true" on-confirm="groupConfirm()">
					<div class="add-new-block" >
						<i class="wi wi-plus"></i> 添加应用权限组
					</div>
				</we7-modal-app>
				<div class="we7-header">公众号附加应用</div>
				<div class="group-post-mudules">
					<div class="module-item" ng-repeat="module in modulesAll.modules" ng-if="module.checked == 1">
						<input type="hidden" name="extra[modules][]" ng-value="module.name">
						<div class="logo">
							<img ng-src="{{module.logo}}" alt="">
						</div>
						<div class="info">
							<div ng-bind="module.title" class="title text-over">1213</div>
							<div class="icon">
								<i class="{{module.support | moduleInfo:'icon'}}"></i>
							</div>
						</div>
						<div class="delete">
							<i class="wi wi-error" ng-click="module.checked = 0"></i>
						</div>
					</div>
					<div class="module-item" ng-repeat="template in modulesAll.templates"  ng-if="template.checked == 1">
						<input type="hidden" name="extra[templates][]" ng-value="template.id">
						<div class="logo">
							<img ng-src="{{template.logo}}" alt="">
						</div>
						<div class="info">
							<div class="name text-over" ng-bind="template.title">1213</div>
							<div class="icon">
								<i class="wi wi-template"></i>
							</div>
						</div>
						<div class="delete">
							<i class="wi wi-error" ng-click="template.checked = 0"></i>
						</div>
					</div>
					<we7-modal-app module-list="modulesAll" title="'添加应用'" multiple="true">
						<div class="module-item add" >
							<i class="wi wi-plus"></i> 添加应用
						</div>
					</we7-modal-app>
				</div>
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="下一步" class="btn btn-primary btn-submit"/>
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
			</div>
			<div class="modal" id="jurisdiction-add">
				<div class="modal-dialog we7-modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<ul role="tablist" class="nav nav-pills">
								<li class="active"><a class="we7-padding-horizontal" data-toggle="tab" role="tab" aria-controls="content-modules" href="#content-modules">模块</a></li>
								<li><a class="we7-padding-horizontal" data-toggle="tab" role="tab" aria-controls="content-templates" href="#content-templates">模板</a></li>
							</ul>
						</div>
						<div class="modal-body">
							<div class="tab-content">
								<div id="content-modules" class="tab-pane active" role="tabpanel">
									<table class="table we7-table table-hover vertical-middle">
										<col width="280px">
										<col width="220px">
										<col />
										<tr>
											<th>模块名称</th>
											<th>模块标识</th>
											<th></th>
										</tr>
										<?php  if(is_array($modules)) { foreach($modules as $module) { ?>
										<tr>
											<td><?php  echo $module['title'];?><?php  if($module['issystem']) { ?><span class="label label-success">系统模块</span><?php  } ?></td>
											<td><?php  echo $module['name'];?></td>
											<td><a class="btn btn-default js-btn-select <?php  if(is_array($extend['modules']) && in_array($module['name'], $extend['modules'])) { ?>btn-primary<?php  } ?>" data-title="<?php  echo $module['title'];?>" data-name="<?php  echo $module['name'];?>" onclick="$(this).toggleClass('btn-primary')">选取</a></td>
										</tr>
										<?php  } } ?>
									</table>
								</div>
								<div id="content-templates" class="tab-pane" role="tabpanel">
									<table class="table we7-table table-hover vertical-middle">
										<col width="280px">
										<col width="220px">
										<col />
										<tr>
											<th>模板名称</th>
											<th>模板标识</th>
											<th></th>
										</tr>
										<?php  if(is_array($templates)) { foreach($templates as $temp) { ?>
										<tr>
											<td><?php  echo $temp['title'];?></td>
											<td><?php  echo $temp['name'];?></td>
											<td><a class="btn btn-default js-btn-select <?php  if(is_array($extend['templates']) && in_array($temp['id'], $extend['templates'])) { ?>btn-primary<?php  } ?>" data-title="<?php  echo $temp['title'];?>" data-name="<?php  echo $temp['id'];?>" onclick="$(this).toggleClass('btn-primary')">选取</a></td>
										</tr>
										<?php  } } ?>
									</table>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" ng-click="addPermission()">确定</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">
		angular.module('accountApp').value('config', {
			notify: <?php echo !empty($notify) ? json_encode($notify) : 'null'?>,
			owner: <?php echo !empty($owner) ? json_encode($owner) : 'null'?>,
			unigroups: <?php echo !empty($unigroups) ? json_encode($unigroups) : 'null'?>,
			modules: <?php echo !empty($modules) ? json_encode($modules) : 'null'?>,
			templates: <?php echo !empty($templates) ? json_encode($templates) : 'null'?>,
			links: {
				userinfo: "<?php  echo url('account/post-step', array('step' => 3, 'get_type' => 'userinfo'))?>",
			}
		});
		angular.bootstrap($('#js-account-post-step3'),['accountApp']);
	</script>
<?php  } else if($_GPC['step'] == 4) { ?>
	<div class="account-list-add-step">
		<ol class="breadcrumb we7-breadcrumb">
			<a href="<?php  echo url('account/manage', array('account_type' => ACCOUNT_TYPE_OFFCIAL_NORMAL))?>"><i class="wi wi-back-circle"></i> </a>
			<li><a href="<?php  echo url('account/manage', array('account_type' => ACCOUNT_TYPE_OFFCIAL_NORMAL))?>">公众号列表</a></li>
			<li>新建公众号</li>
		</ol>
		<ul class="we7-step">
			<li ><span class="content">1. 设置公众号信息</span></li>
			<?php  if(!empty($_W['isfounder'])) { ?>
			<li ><span class="content">2. 设置权限</span></li>
			<li class="active"><span class="content">3. 引导页面</span></li>
			<?php  } else { ?>
			<li class="active"><span class="content">2. 引导页面</span></li>
			<?php  } ?>
		</ul>
		<div class="we7-form" id="js-account-post-step4" ng-controller="AccountPostStepFour" ng-cloak>
			<!--第四步:引导页面-->
			<p class="alert alert-info">您绑定的微信公众号：<strong ng-bind="account.name"></strong>，请按照下列引导完成配置。</p>
			<div class="panel we7-panel" ng-if="account.isconnect == 0">
				<div class="panel-heading">
					第一步
				</div>
				<div class="panel-body">
					<div class="alert">
						<i class="wi wi-info-sign"></i>
						<span>登录 <a href="https://mp.weixin.qq.com/" class="color-default" target="_blank">微信公众平台</a>，点击左侧菜单最后一项，进入 [ <em class=" color-red">开发者中心</em> ]</span>
					</div>
					<div class="form-group">
						<div class="img"><img src="./resource/images/guide-01.png"></div>
						<p># 如果您未成为开发者，请勾选页面上的同意协议，再点击 [ <em class="color-red">成为开发者</em> ] 按钮</p>
					</div>
				</div>
			</div>
			<div class="panel we7-panel" ng-if="account.isconnect == 0">
				<div class="panel-heading">
					第二步
				</div>
				<div class="panel-body">
					<div class="alert">
						<i class="wi wi-info-sign"></i>
						<span>在开发者中心，找到［<em class="color-red"> 服务器配置</em> ］栏目下URL和Token设置</span>
					</div>
					<div class="form-group">
						<div class="img"><img src="./resource/images/guide-02.png"/></div>
						<p># 将以下链接链接填入对应输入框：</p>
							<div class="form-group clip">
								<label class="col-sm-1 control-label">URL:</label>
								<div class="col-sm-11 input-group">
									<p class="form-control-static">
										<a href="javascript:;"><?php  echo $_W['siteroot'];?>api.php?id=<?php  echo $account['acid'];?></a>
										<a href="javascript:;" id="copy-0" class="color-default" clipboard supported="supported" text="url" on-copied="success('0')">&nbsp;&nbsp;点击复制</a>
									</p>
								</div>
							</div>
							<div class="form-group clip">
								<label class="col-sm-1 control-label">Token:</label>
								<div class="col-sm-11 input-group">
									<p class="form-control-static">
										<a href="javascript:;" ng-bind="account.token"></a>
										<a href="javascript:;" id="copy-1" class="color-default" clipboard supported="supported" text="account.token" on-copied="success('1')">&nbsp;&nbsp;点击复制</a>
									</p>
								</div>
							</div>
							<div class="form-group clip">
								<label class="col-sm-2 control-label">EncodingAESKey:</label>
								<div class="col-sm-10 input-group">
									<p class="form-control-static">
										<a href="javascript:;" title="点击复制EncodingAESKey" ng-bind="account.encodingaeskey"></a>
										<a href="javascript:;" id="copy-2" class="color-default" clipboard supported="supported" text="account.encodingaeskey" on-copied="success('2')">&nbsp;&nbsp;点击复制</a>
									</p>
								</div>
							</div>
						<p># 如果以前已填写过URL和Token，请点击[<em class=" color-red"> 修改配置 </em>] ，再填写上述链接</p>
						<p># 请点击 [<em class=" color-red"> 启用 </em>] ，以启用服务器配置：</p>
						<div class="img"><img src="./resource/images/guide-03.png" width="524"></div>
					</div>
				</div>
			</div>
			<div class="panel we7-panel">
				<div class="panel-heading">
					第三步
				</div>
				<div class="panel-body">
					<div class="alert">
						<i class="wi wi-info-sign"></i>
							<span class="color-red" ng-if="account.isconnect == 1">公众号 <span ng-bind="account.name"></span> 接入成功</span>
							<span class="color-red" ng-if="account.isconnect == 0">公众号 <span ng-bind="account.name"></span> 正在等待接入……请及时按照以上步骤操作接入公众平台</span>
					</div>
					<div class="form-group">
						<div ng-if="account.isconnect == 0">
							<p># 检查公众平台配置</p>
							<p># 编辑公众号 <a ng-href="{{links.post}}acid={{account.acid}}&uniacid={{account.uniacid}}"><?php  echo $account['name'];?></a></p>
							<a href="javascript:window.location.reload();" class="btn btn-success">检测是否接入成功</a>&nbsp;
							<a ng-href="{{links.switch}}uniacid={{account.uniacid}}" class="btn btn-primary">暂不接入，先去查看公众号功能</a>&nbsp;
							<a ng-href="{{links.manage}}" class="btn btn-info">返回公众号列表</a>
						</div>
						<div ng-if="account.isconnect == 1">
							<a ng-href="{{links.post}}acid={{account.acid}}&uniacid={{account.uniacid}}" class="btn btn-primary">管理公众号</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		angular.module('accountApp').value('config', {
			account: <?php echo !empty($account) ? json_encode($account) : 'null'?>,
			links: {
				siteroot: "<?php  echo $_W['siteroot'];?>",
				post: "<?php  echo url('account/post')?>",
				manage: "<?php  echo url('account/manage', array('account_type' => ACCOUNT_TYPE_OFFCIAL_NORMAL))?>",
				wxapp_manage: "<?php  echo url('account/manage')?>",
				switch: "<?php  echo url('account/display/switch')?>",
			}
		});

		angular.bootstrap($('#js-account-post-step4'),['accountApp']);
	</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>