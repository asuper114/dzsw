<?php

/*----------------------------------------------------
	[dzsw] languages/admin.php 

----------------------------------------------------*/
$lang_price = array(
	'common_'								=> '价格：',
	'specials_'								=> '特价：',
);

$lang_a_menu = array(

	'settings'								=> '系统设置',
	'settings_common'						=> '常规设置',
	'settings_base'							=> '基本配制',
	'settings_email'						=> '邮件发送',
	'settings_show'							=> '显示设置',
	'settings_num'							=> '数量设置',
	'settings_mark'							=> '功能设置',
	'settings_seo'							=> '搜索引擎优化',
	'settings_shipping'						=> '配送设置',
	'settings_payment'						=> '付款设置',

	'news'									=> '新闻设置',
	'news_all'								=> '所有新闻',
	'news_add'								=> '添加新闻',

	'gbook'									=> '留言本',
	'gbook_all'								=> '所有留言',
	'gbook_replay'							=> '已回复留言',

	'links'									=> '链接设置',
	'links_all'								=> '所有链接',
	'links_add'								=> '添加链接',

	'class'									=> '分类设置',
	'class_inheader'						=> '顶部分类',
	'class_add'								=> '添加分类',
	'class_edit'							=> '编辑分类',
	'class_merge'							=> '合并分类',

	'product'								=> '商品设置',
	'lookclass'								=> '查看分类',
	'product_add'							=> '添加商品',
	'product_search'						=> '搜索商品',
	'product_specials'						=> '特价商品',

	'order'									=> '定单设置',
	'order_all'								=> '所有定单',
	'order_search'							=> '查找定单',
	'order_goodsarrive'						=> '送货上门订单',
	'order_goodsself'						=> '货到付款订单',

	'order_noauditing'						=> '新定单',
	'order_auditing'						=> '已审核定单',
	'order_waitforpay'						=> '等待付款定单',
	'order_partpay'							=> '部分付款定单',
	'order_allpay'							=> '全部付款定单',
	'order_partpay'							=> '部分付款的定单',
	'order_allpay'							=> '全部付款定单',
	'order_partsend'						=> '部分发送订单',
	'order_allsend'							=> '全部发送订单',
	'order_makesurepay'						=> '已确认付款订单',
	'order_makesurepay'						=> '已确认付款订单',
	'order_cancel'							=> '取消的定单',
	'order_shipping'						=> '正在付款的定单',
	'order_waitforsend'						=> '等待发送的定单',
	'order_partsend'						=> '部分发送的定单',
	'order_allsend'							=> '全部发送的定单',
	'order_sendsuccess'						=> '发送成功的定单',
	'order_sendfail'						=> '发送失败的定单',
	'order_over'							=> '交易结束的定单',
	'order_getexchange'						=> '收到退换货的定单',
	'order_payback'							=> '已退款的定单',

	'mark'									=> '功能选项',
	'mark_lossremark'						=> '查看缺货登记',

	'customer'								=> '会员设置',
	'customer_all'							=> '所有会员',
	'customer_edit'							=> '编辑会员',

	'adminer'								=> '管理人员设置',
	'adminer_all'							=> '所有管理人员',
	'adminer_add'							=> '添加管理人员',

	'group'									=> '组设置',
	'group_customer'						=> '会员组设置',
	'group_adminer'							=> '管理组设置',

	'style_template'						=> '模板风格',
	'style'									=> '风格设置',
	'template'								=> '模板设置',

	'database'								=> '数据库',
	'database_update'						=> '数据库更新',

	'dzswset'								=> 'dzsw设置',
	'dzswset_rzset'						=> '认证设置',
	
	'tools'									=> '系统工具',
	'tools_updatecache'						=> '更新缓存',
	'tools_sendmail'						=> '发送邮件',
);

$lang_a_common = array(
	'add'								=> '添加',
	'add:'								=> '添加：',
	'edit:'								=> '编辑：',
	'edit'								=> '编辑',
	'delete'							=> '删除',
	'delete:'							=> '删除：',
	'see'								=> '查看',
	'submit'							=> '提交',
	'sort:'								=> '排序：',
	'title'								=> '名称',
	'delete_small'						=> '删！',
	'value:'							=> '值：',
	'value'								=> '值',
	'yes'								=> '是',
	'no'								=> '否',
	'key:'								=> '关健字：',

	'forbid'							=> '权限受限，无法操作，请使用管理员身份登陆。',

	'click_to_edit'						=> '点击编辑',
	'click_to_open'						=> '点击打开',
	'click_to_close'					=> '点击关闭',

	'boared_system_set'					=> '系统设置面板',
);

$lang_a_message = array(
	'forbid'							=> '权限受限，无法操作，请使用管理员身份登陆。',	

	'check_to_turn'						=> '如果您的浏览器没有自动跳转，请点击这里。',	
	
	'login_success'						=> '恭喜您！登陆成功。',	
	'login_error_emailempty'			=> '对不起！请输入您的管理员用户名。',
	'login_error_passwordempty'			=> '对不起！请输入您的管理员密码。',
	'login_error_checknumempty'			=> '对不起！请输入您的验证码。',
	'login_error_checknumerror'			=> '对不起！请输入正确的验证码。',
	'login_error_ill'					=> '对不起！您输入的用户名或密码错误。',

	'operate_success'					=> '恭喜您！您刚才的操作成功进行。',
	'update_success'					=> '恭喜您！数据更新成功。',

	'add_payment_a_success'				=> '恭喜您！添加付款方式参数成功。',
	
	'style_editfile_success'			=> '恭喜您！CSS 文件成功更新。',
	'style_editfile_dirwriteerror'		=> '对不起！目录“styles/”不可写，CSS 文件更新失败。',

	'mail_send_success'					=> '恭喜您！电子邮件成功发送。',

	'shipping_deletefeearea_success'	=> '恭喜您！选定的费区成功删除。',	
	'shipping_addfeearea_success'		=> '恭喜您！费区成功添加，请不要忘了编辑其地区和费用。',
	'shipping_error_areaexits'			=> '对不起！此地区已经存在列表中了。',
	'shipping_error_areaexits_othor'	=> '对不起，此配送方式的其它费区中已经选择了此地区。',

	'news_add_success'					=> '恭喜您！商城新闻成功添加。',
	'news_update_success'				=> '恭喜您！商城新闻成功更新。',
	'news_delete_success'				=> '恭喜您！商城新闻成功删除。',

	'link_add_success'					=> '恭喜您！新链接添加成功。',
	'link_update_success'				=> '恭喜您！链接更新成功。',

	'specials_product_update_success'	=> '恭喜您！特价商品更新成功。',
	'product_num_update_success'		=> '恭喜您！商品数量成功更新。',
	'product_add_success'				=> '恭喜您！商品成功添加。',
	'product_edit_success'				=> '恭喜您！商品成功更新。',

	'product_copy_exitsclass'			=> '对不起！此分类中已经存在了此商品。',
	'product_copy_exitsclass'			=> '对不起！此分类中已经存在了此商品。',
);

$lang_a_msg = array(
	'payment_pay_key_exists'			=> '对不起！此付款方式的关健字已经存在，请换一个在试。',
	'payment_pakey_exists'				=> '对不起！此配制参数的关健字已经存在，请换一个在试。',

	'style_cannot_delete'				=> ' 为系统默认风格，不能删除，如果必须删除，请将其它风格设为默认风格，然后在删除此风格。',

	'template_directory_error_1'		=> '模板目录不能以“/”结尾，请修改。',
	'template_directory_error_2'		=> '模板目录 %s 不存在，请在“templates/” 文件夹下建立 目录 %s ，然后在次提交。',
	'template_delete_detault_error'		=> '您不能删除系统默认模板。',
	'template_edit_detaultdirectory_error'	=> '您不能修改系统默认模板目录设置。',

);

$lang_a_error = array(
	'create_emailhtml'					=> '您的  "'.DIR_dzsw.'data/emailtemplate/" 目录不可写，请将其设为可写属性。',
	'create_js'							=> '您的  "'.DIR_dzsw.'js/" 目录不可写，请将其设为可写属性。',
	'create_cache'						=> '您的  "'.DIR_dzsw.'data/cache/" 目录不可写，请将其设为可写属性。',
);

$lang_a_top = array(
	'border_system'						=> '系统控制面板',
	'changepw'							=> '修改登陆密码',
	'logout'							=> '退出',
	'user_bbs'							=> '用户社区',
	'user_help'							=> '使用帮助',
	'shop_index'						=> '商城首页',
);

$lang_a_main = array(
	'header_1'							=> '欢迎光临',
	'header_2'							=> '系统设置面板',
	'systeminfo'						=> '系统信息',
	'php_os_'							=> '服务器系统：',
	'serverfoft_'						=> '服务器引擎：',
	'phpversion_'						=> 'PHP版本：',
	'mysqlversion_'						=> 'MYSQL版本：',
	'prococol_'							=> '通信协议：',
	'allowgdlibrary_'					=> 'GD库支持：',
	'register_global_'					=> '全局变量：',
	'safemode'							=> '安全模式：',
	'open'								=> '开',
	'close'								=> '关',
	'allow'								=> '支持',
	'noallow'							=> '不支持',
	'uploadfile_'						=> '上传文件：',
	'uploadfile_forbid_'				=> '禁止：',
	'file_'								=> '文件：',
	'post_'								=> '表单：',
	'shopversion_'						=> 'dzsw 版本：',
	'datacount'							=> '数据统计',
	'class_count_'						=> '商品分类个数：',
	'product_count_'					=> '商品个数：',
	'cutomer_count_'					=> '注册会员：',
	'order_count_'						=> '订单个数：',
	'order_new_'						=> '新订单：',
	'development_group'					=> '开发团队',
	'copyright_'						=> '版权所有：',
	'script_develop_design_'			=> '程序开发与设计：',
	'face_design_'						=> '界面设计：',
	'face_art_'							=> '界面美工：',
	'community'							=> '技术支持论坛：',

	'mail_method_'						=> '邮件模式：',
);

$lang_a_adminchangepw = array(
	'title_'							=> '修改登陆密码',
	'currentpw_'						=> '当前密码：',
	'newpw_'							=> '新密码：',
	'newpw2_'							=> '确认新密码：',

	'msg_currentpw_empty'				=> '请输入当前密码。',
	'msg_newpw_small'					=> '新密码不能少于6位。',
	'msg_passwordnotsame'				=> '新密码与确认新密码不相同，请重新输入。',

	'message_changesuccess'				=> '恭喜您！密码修改成功。',
	'message_currentw_error'			=> '对不起！您输入的当前密码不正确。',
);

$lang_a_settings = array(
	'option'							=> '选项',
	'value_1'							=> '值',
);

$lang_a_classes = array(
	'class_name_'						=> '分类名称：',
	'class_top_'						=> '上级分类：',
	'class_one'							=> '一级分类',
	'class_two'							=> '二级分类',
	'class_three'						=> '三级分类',
	'class_four'						=> '四级分类',


	'class_all'							=> '所有分类',
	'class_show_inheader'				=> '查看在页面顶部显示的分类',
	'show_inheader_'					=> '是否在页面上部显示：',
	'class_edit'						=> '编辑分类',
	
	'merge_formerly_'					=> '请选择源分类：',
	'merge_formerly'					=> '请选择源分类',
	'merge_aim_'						=> '请选择目标分类：',

	'notice_merge'						=> '<li>注意：只有同级分类才能合并。</li><li>如果您的浏览器禁止了 javascript 功能，您将无法进行下面的操作。</li>',
	'notice_showinheader'				=> '<li>请输入0-99之间的整数，其中“0”表示 不在页面上部显示，1-99表示在页面上部显示，数字越小越靠前。</li>',

	'message_class_add_success'			=> '恭喜您！分类添加成功。',
	'message_class_delete_success'		=> '恭喜您！分类删除成功。',
	'message_class_merge_success'		=> '恭喜您！分类合并成功。',
	'message_class_edit_success'		=> '恭喜您！分类编辑成功。',
	
	'delete_warning_childs'				=> '此分类下包含 %s 个子分类，如果删除此分类，此分类下的所有子分类及其子分类下的商品也将被删除，您确定删除吗？',
	'delete_warning_products'			=> '此分类或是此分类的子分类下包含 %s 个商品，如果删除此分类，此分类下的所有子分类及其子分类下的商品也将被删除，您确定删除吗？',
	'delete_warning_safe'				=> '此分类下没有任何商品和子分类，可以安全删除，您确定删除吗？',
);

$lang_a_editor = array(
	'endo'								=> '撤销',
	'redo'								=> '恢复',
	'bold'								=> '粗体',
	'italic'							=> '斜体',
	'underline'							=> '下划线',
	'justifyleft'						=> '左对齐',
	'justifycenter'						=> '居中',
	'justifyright'						=> '右对齐',
	'createlink'						=> '插入链结',
	'addtable'							=> '插入表格',
	'addtable'							=> '插入表格',
	'forecolor'							=> '字体颜色',
	'selectcolor'						=> '选择字体颜色',
	'outdent'							=> '减小缩进',
	'indent'							=> '增加缩进',
	'addline'							=> '插入水平线',
	'formatblock_ol'					=> '编号',
	'formatblock_ul'					=> '项目符号',
	'removeformat'						=> '去除格式',
	'selectfontname'					=> '选择字体',
	'selectfontsize'					=> '字体大小',
	'fontsize'							=> '号字',
	'selectblockformat'					=> '段落格式',
	'blockformat_common'				=> '普通',
	'blockformat_already_format'		=> '已编排格式',
	'blockformat_subject_1'				=> '标题一',
	'blockformat_subject_2'				=> '标题二',
	'blockformat_subject_3'				=> '标题三',
	'blockformat_subject_4'				=> '标题四',
	'blockformat_subject_5'				=> '标题五',
	'blockformat_subject_6'				=> '标题六',

	'table_mustnummber'					=> '必须由数字组成！',
	'table_mustbigorequality'			=> '必须大于或等于',
);

$lang_a_news = array(
	'title'								=> '新闻标题',
	'title_'							=> '新闻标题：',
	'body:'								=> '新闻内容：',
	'adddate'							=> '添加日期',

	'add:'								=> '添加新闻：',
	'edit:'								=> '编辑新闻：',
);

$lang_a_gbook = array(
	'textmain_'							=> '留言内容：',
	'textreplay_'						=> '回复内容：',
	'author'							=> '作者',
	'date'								=> '留言日期',

	'reply'								=> '回复',

	'editmain_'							=> '编辑留言：',
	'editreply_'						=> '编辑回复：',
	'replymain_'						=> '回复留言：',
);

$lang_a_links = array(
	'friend_links'						=> '友情链接：',
	'sitename_'							=> '网站名称：',
	'sitename'							=> '网站名称',
	'link_'								=> '链接：',
	'logosrc_'							=> 'logo图片：',

	'link_result'						=> '链接效果',
);

$lang_a_lossremark = array(
	'pname_'							=> '商品名称：',
	'date_add_'							=> '提交日期：',
	'description_'						=> '商品描述：',
	'email_'							=> '顾客email：',

	'email_empty'						=> '顾客没有输入email',
	'sendmail_'							=> '发送电邮',
);

$lang_a_style = array(
	'edit_style'						=> '编辑风格',

	'style_name_'						=> '风格名称：',
	'style_name_desc'					=> '识别界面风格的标志，请勿使用空格或特殊符号',
	'template_'							=> '匹配模板：',
	'template_desc'						=> '与本套风格相匹配的模板名称。',
	'imagedir_'							=> '风格图片目录：',
	'imagedir_desc'						=> '与本套风格相匹配的图片目录。',
	'css_file_name:'					=> 'CSS 文件名称：',
	'css_file_name_desc'				=> '本风格所用CSS 文件名。',

	'style_name'						=> '风格名称',
	'style_template'					=> '配套模板',
	'style_charset'						=> '字符集',
	'style_file'						=> '风格文件',

	'style_editfile'					=> '编辑风格文件',

	'import_cssfile:'					=> '导入风格文件：',
);

$lang_a_mail = array(
	
	'sendmail:'							=> '发送邮件：',
	'sendto:'							=> '收件人：',
	'subject:'							=> '标题：',
	'mailmain:'							=> '内容：',

	'allcustomer'						=> '所有会员',

	'notice'							=> '<li>在这个选项里您可以发送电子邮件讯息给所有的会员或是特定的团队的成员。</li><li>如果收件人数过多，系统需要较长的时间来执行,请在邮件送出之后耐心等候, 切勿在程序完成之前停止网页动作。</li><li>多个邮件之间可用“,”隔开</li>',
);

$lang_a_login = array(
	'header_title:'						=> '请输入您的用户名和密码：',
	'username:'							=> '用户名：',
	'password:'							=> '密&nbsp;&nbsp;&nbsp;码：',
	'checknum:'							=> '验证码：',

	'message_illmore'					=> '对不起，您登陆的错误次数超过了 dzsw 系统设置的时限，您将在15分钟内无法登陆。',
);

$lang_a_template = array(

	'template_name'						=> '模板名称',
	'template_charset'					=> '字符集',
	'template_directory'				=> '模板目录',
);

$lang_a_order = array(
	'list_customer'						=> '顾客',
	'list_total_price'					=> '总计',
	'list_dateadd'						=> '添加日期',
	'list_status'						=> '状态',

	'search_from_id'					=> 'ID精确搜索',
	'search_id'							=> '订单ID',
	'order_id_'							=> '订单号：',
	'search_id_desc'					=> '多个订单号之间可用‘,’隔开。',
	'search_order'						=> '搜索订单',
	'emailinclude'						=> '顾客Email包含：',
	'orderstatus_'						=> '订单状态：',
	'allstatus'							=> '所有状态',
	'orderstatus_'						=> '订单状态：',
	'cnameinclude_'						=> '收货人或订货人姓名包含：',
	'pnameinclude_'						=> '商品名称包含：',
	'ordertotal_'						=> '订单总额：',
	'moneybig_'							=> '大于：',
	'moneysmall_'						=> '小于：',
	'datepurchased_'					=> '订购日期：',
	'alltime'							=> '所有日期',
	'oneday'							=> '一天',
	'twoday'							=> '二天',
	'oneweek'							=> '一周',
	'onemonth'							=> '一个月',
	'threemonth'						=> '三个月',
	'sixmonth'							=> '六个月',
	'oneyear'							=> '一年',
	'after'								=> '之前',
	'before'							=> '之后',

	'alreadypay_'						=> '已付款：',
	'cancel_why_'						=> '取消原因：',
	'cancel_why_define_'				=> '自定义：',

	'customer_'							=> '顾客：',
	'print'								=> '打印此订单',
	'dillingaddress_'					=> '送货地址：',
	'products_'							=> '订单商品：',
	'total_'							=> '订单总计：',
	'dellingaddress_'					=> '订单地址：',
	'tel_regular_'						=> '固定电话：',
	'customer_name_'					=> '姓名：',
	'tel_mobile_'						=> '移动电话：',
	'address_detail_'					=> '详细地址：',
	'postcode_'							=> '邮政编码：',
	'dell_s_bill'						=> '订单人地址和收货人地址相同',
	'payment_method_'					=> '付款方式：',
	'shipping_method_'					=> '送货方式：',
	'order_admin'						=> '订单管理',
	'delete_order'						=> '删除订单',
	'cancel_order'						=> '取消此订单',
	'customer_pay_'						=> '顾客付款：',
	'allpay'							=> '全部付清',
	'sendmail'							=> '发送电邮',
	'account_detail'					=> '账号详细',
	'sendmail_'							=> '发送电邮通知：',

	'order_history_'					=> '订单历史：',
	'order_status_'						=> '订单状态：',
	'date_status_'						=> '状态日期：',
	'pay_platform_'						=> '支付平台：',
	'operator_'							=> '操作：',
	'add_money_'						=> '添加金额：',
	'customer_self'						=> '顾客自己',

	'print_footer'						=> '欢迎光临'.$settings['store_name'],

	'name'								=> '商品名称',
	'price'								=> '价格',
	'quantity'							=> '数量',

	'email_subject_order'				=> '您在'.$settings['store_name'].'的订单处理',
	'email_header_paid'					=> '您在 $create_date 提交的　$orders_id 号订单, 我们收到了您的货款，并对订单进行了处理。',

	'msg_orderpaymustint'				=> '对不起，您输入的顾客付款金额必须为数字。',
	'msg_ordereditforbid'				=> '对不起，此订单的订单状态不允许编辑。',
	'msg_ordercancelforbid'				=> '对不起，此订单的订单状态不允许取消。',

	'payback_tomyaccount'				=> '此顾客选择了将余款放入其账户中，您只需点击提交按钮，dzsw 系统会自动处理其余款。',
	'payback_toall_bypost'				=> '此顾客选择了将余款全部退回其本人，退款方式为邮局付款，请将余款汇款至此订单的“订单地址”。',
	'payback_toall_bybank'				=> '此顾客选择了将余款全部退回其本人，退款方式为银行汇款，请将余款汇款至：<ul><li>持卡人姓名： $name </li><li> 卡号：$cartnum </li><li>开户银行：$bankname</li></ul>',
);

$lang_a_customer = array(
	'account_'							=> '会员账户：',
	'account'							=> '会员账户',
	'credit'							=> '会员积分',
	'credit_'							=> '会员积分：',
	'group'								=> '会员组',
	'group_'							=> '会员组：',
	'groupall'							=> '所有会员组',
	'order'								=> '顾客订单',
	'search'							=> '搜索会员',
	'emailinclude_'						=> 'E_mail 包含：',
	'morethan_'							=> '大于：',
	'lessthan_'							=> '小于：',
	'sendmail'							=> '发送邮件',
	'click_to_send'						=> '请点击',

	'detail'							=> '会员详细信息',
	'regdate_'							=> '注册日期：',
	'lastvisit_'						=> '最后登陆：',
	'credit_'							=> '会员积分：',
	'leavemoney_'						=> '账户余额：',
	'qq_'								=> 'QQ：',
	'msn_'								=> 'MSN：',

	'msg_email_format_error'			=> '对不起，请输入正确的email地址。',

	'mssage_update_success'				=> '恭喜您！会员组成功更新。如您添加了新的会员组，<br>请不要忘记修改其会员组折扣。',
	'mssage_update_speiclas_success'	=> '恭喜您！特殊会员组成功更新。',

);

$lang_a_admin = array(
	'account'							=> '账号',
	'account_'							=> '账号：',
	'password_'							=> '密码：',
	'password2_'						=> '确认密码：',
	'groupof_'							=> '所属管理组：',
	'createdate_'						=> '生成日期：',
	'lastvisit_'						=> '最后访问：',
	'updatemessage'						=> '如果不需要修改密码，请将密码项留空。',

	'add_adminer'						=> '添加管理人员',

	'msg_account_exists'				=> '此账号已经存在，请换一个账号在试。',
	'msg_account_notyou'				=> '此账号不是您的账号，您不能编辑。',
	'msg_password_small'				=> '对不起，密码不能少于6位。',
	'msg_account_empty'					=> '对不起，请输入管理员账号。',
	'msg_password_notsame'				=> '对不起，两次密码输入不一致，请重新输入。',
);

$lang_a_group_admin = array(
	'product_classes_'					=> '商品分类：',
	'product_classes_desc'				=> '“查看“是必须权限，即如果没有”查看“权限，则”编辑“，”添加“，”删除“权限无效。<br />其中“编辑”包括“修改”和“合并”。',
	'product_'							=> '商品设置：',
	'product_desc'						=> '“查看“是必须权限，即如果没有”查看“权限，则”编辑“，”添加“，”删除“权限无效。',
	'customer_'							=> '顾客信息：',	
	'customer_desc'						=> '“查看“是必须权限，即如果没有”查看“权限，则”编辑“，”添加“，”删除“权限无效。',	
	'news_'								=> '商城新闻：',	
	'gbook_'							=> '顾客留言：',	
	'reply'								=> '回复',
	'links_'							=> '商城链接：',	
	'sendmail_'							=> '允许发送商城邮件：',
	'sendmail_desc'						=> '是否允许使用系统工具处的发送邮件功能：',
	
	'order_'							=> '商城订单：',
	'order_desc'						=> '只有允许查看商城订单，才能对订单状态进行操作。',
	'allow_orderstatus_'				=> '允许操作的订单状态：',	
	'allow_orderstatus_desc'			=> '订单下一步状态与允许操作的订单状态相同时，订单就可以编辑（即拥有管理权限的管理人员可以改变订单状态或输入订单金额）<br /><br />例：订单状态是“正在配货”,下一步的订单状态是“等待发货”，那么如果此管理组允许操作“等待发货”状态，那么此管理组的管理人员则可以对其进行操作。',	
	'order_mustpay'						=> '款到发货订单',	
	'order_goodsarrivepay'				=> '货到付款订单',	
	
	'group_name'						=> '组头衔',
	'purview'							=> '权限',
	'allpurview'						=> '所有权限',

	'delete_error'						=> '您要删除的管理组中包含以下的管理人员，请删除以下的管理人员或编辑使其属于其它的管理组。',
	
	'notice'							=> '管理组头衔没有实在意义，只是一种区别，便于记忆。',
	'notice_detail'						=> '打勾表示赋予此管理级此权限。',	
);

$lang_a_group_customer = array(
	'notice'							=> '<li>&nbsp;&nbsp;&nbsp;&nbsp;dzsw 商城系统的会员组为会员积分来确定。特殊组不受积分限制。每个组可以分别设置相应的折扣。特殊组的会员需要在编辑会员资料时将该会员加入特殊组。 <li>&nbsp;&nbsp;&nbsp;&nbsp;会员组积分设定的总体范围必须能满足实际的要求，如 0 到 3000，而且，不同的组之间积分范围不要出现重叠，否则将出现部分顾客无法登陆的问题。 <li>&nbsp;&nbsp;&nbsp;&nbsp;折扣请填写数字，如：7折，就直接写入。开启会员积分功能，请点击　常规选项，积分设置，开启会员积分功能<li>&nbsp;&nbsp;&nbsp;&nbsp;标记为　*　的会员组的折扣为商城默认折扣。 ',
	'member_group'						=> '会员组',
	'specials_group'					=> '特殊组',
	'group_name'						=> '组头衔',
	'creditarea'						=> '积分区域',
	'discount'							=> '折扣',
	'creditto'							=> '至',
	'includeuser'						=> '包含用户',
);

$lang_a_product = array(
	'detail_common'						=> '常规信息',
	'detail_desc'						=> '商品描述',
	'detail_image'						=> '商品图片',
	'detail_classes'					=> '商品分类',
	'detail_price'						=> '商品价格',
	
	'classesnow_'						=> '此商品目前属于以下的商品分类：',
	'classes_'							=> '商品分类：',
	'newclasses_'						=> '将此商品添加到下面的分类中：',
	'choose_classes'					=> '请选择',

	'name_'								=> '商品名称：',
	'name'								=> '商品名称',
	'show_yesorno_'						=> '是否显示：',
	'show_yesorno'						=> '是否显示',
	'manufacturer_'						=> '生产厂家：',
	'price_'							=> '价格：',
	'price'								=> '价格',
	's_price_'							=> '特价：',
	's_price'							=> '特价',
	'quantity_'							=> '数量：',
	'quantity'							=> '数量',
	'model_'							=> '型号：',
	'weight_'							=> '重量：',
	'weight'							=> '重量',
	'base_info_'						=> '基本信息：',
	'description_'						=> '详细说明：',

	'add_product'						=> '添加商品',
	'look_product'						=> '查看商品',
	
	'search_product'					=> '搜索商品',

	'copy_product'						=> '复制商品',
	'chose_aim_class_'					=> '选择目标分类：',
	'copy_method_'						=> '复制方法：',
	'copy_link_'						=> '链接：',
	'copy_copy_'						=> '复制：',

	'delete_class'						=> '删除此分类',
	'delete_class_error'				=> '对不起！您必须至少选择一个分类。',

	'status_0_'							=> '显示：',
	'status_1_'							=> '隐藏：',
	'status_emptye_'					=> '不限：',

	'checkall'							=> '全选',
	'tochose'							=> '请选择',
	'delete_specails'					=> '删除特价',
	'edit_specails'						=> '编辑特价',
	'set_specails'						=> '设置特价',
	'set_quantity'						=> '设置数量',

	'order_history_'					=> '订单历史：',
	'addimage_'							=> '添加图片：',
	'productimage_'						=> '商品图片：',
	'image_desc_'						=> '图片说明：',
	'upload_image_desc'					=> '添加图片可以使用“添加多个图片”链接同时上传多个图片',
	'image_setdefault_'					=> '设为默认图片：',
	'image_setdefault'					=> '设为默认图片',
	'image_default'						=> '默认图片',
	'addmoreimage_'						=> '（添加多个图片）',

	'msg_productcannotempty'			=> '对不起，请至少选择一个商品。',
);

$lang_a_shipping = array(
	'shipping_control'					=> '配送方式设置',
	'add_new_shipping'					=> '添加新配送方式',
	'shipping_title_'					=> '配送名称：',
	'shipping_title'					=> '配送名称',
	'define_title_'						=> '自定义配送名称：',
	'desc_faq:'							=> '客户自助问题解答内容：',

	'shipping_filename'					=> '费用计算函数文件名：',
	'shipping_filename_desc'			=> '请将此文件放在 ./modules/shipping/ 文件夹下面。',
	'filename_not_exists'				=> '此配送方式的“费用计算函数文件 %s ”不存在，请将其上传到“./modules/shipping/”文件夹里面。',
	'shipping_filename_exists'			=> '此文件名已经存在，请换一个文件名。',

	'fee_area:'							=> '费区：',
	'fee_'								=> '费用标准：',
	'area:'								=> '地区：',
	'addnewfeearea'						=> '添加费区',
	'deletefeearea'						=> '删除费区',

	'click_to_deletearea'				=> '（点击地区名删除）',
);

$lang_a_payment = array(
	'configpam'							=> '配制参数：',
	'payment_control'					=> '配送方式设置',
	'add_new_payment'					=> '添加新付款方式',
	'payment_parent'					=> '付款方式所属分类：',
	'payment_key_desc'					=> '与其它付款方式区别的唯一标识，不能相同，必须为英文。',
	'payment_pakey_desc'				=> '与此付款方式下其它的配制参数区别的唯一标识，不能相同，必须为英文。',
	'payment_define_pa'					=> '自定义参数：',
	'payment_title'						=> '付款方式名称：',

	'title'								=> '名称：',
	'define_title'						=> '自定义名称：',

    'addpam'							=> '添加参数',

);

$lang_a_database = array(
	'update_'							=> '数据库更新－请将数据库更新语句粘贴在下面的文本框中',
	'update_desc'						=> '<li>如果您的语句较多，可能要执行较长时间，程序执行过程中请勿中断。</li><li>如果您不是专业的技术人员，建议您不要对SQL语句进行修改。</li>',
	
	'message_update_fail'				=> '升级错误！MYSQL提示： ',
	'message_update_success'			=> '恭喜您！数据库更新成功。',
);

$lang_a_misc = array(
	'updatecache_success'				=> '全部缓存更新完毕。',
	'logoff_success'					=> '您已成功退出系统设置。',
);

$lang_a_renzheng = array(
	'import_code'						=> '请输入认证码：',
	'message_update_success'			=> '恭喜您！您的认证码更新成功。',
	'header_desc_1'						=> 'dzsw 认证功能是 dzsw 网上商城信用评价的一种表现形式。',
	'header_desc_2'						=> '<a href="http://forum.dzsw.com/viewthread.php?tid=795&extra=page%3D1" target="_blank">请点击这里查看如何进行 dzsw 认证。</a>',
);

$lang_settings = array(
    
    'setting_var'						=> '选项名称：',
    'setting_value'						=> '选项值：',
    
    'setting_store_name'				=>'商城名称：',
    'setting_store_name_desc'			=>'商城名称，将显示在导航条,标题电子邮件中。',
    
    'setting_storeurl'					=>'商城网址：',
    'setting_storeurl_desc'				=>'商城网址，将在邮件及商城页面底部显示。',
    
    'setting_time_ofset'				=>'时差校正：',
    'setting_time_ofset_desc'			=>'如果您的服务器时间显示不正确,可以修改其数值，直到时间显示正确为止。',
    
    'setting_store_description'			=>'商城介绍：',
    'setting_store_description_desc'	=>'商城介绍，对商城进行描述，将显示在页面底部。',

	'setting_server_tel'				=>'商城客户服务 热线：',
    'setting_server_tel_desc'			=>'商城商城客户 服务热线。',

 	'setting_server_email'				=>'商城客户服务 E_mail 邮箱：',
    'setting_server_email_desc'			=>'商城客户服务 E_mail 邮箱。',

	'setting_server_address'			=>'商城客户服务 收信地址：',
    'setting_server_address_desc'		=>'客户退换货寄送地址，客户来信寄送地址。',

	'setting_server_postcode'			=>'商城客户服务 邮编：',
    'setting_server_postcode_desc'		=>'客户退换货寄送地址 邮编，客户来信寄送地址 的邮编。',

	'setting_server_manname'			=>'商城客户服务 收信人：',
    'setting_server_manname_desc'		=>'客户退换货寄送地址 收信人，客户来信寄送地址 的收信人。',

	'setting_email_adminer'				=>'商城管理员电子邮件：',
    'setting_email_adminer_desc'			=>'商城管理员电子邮件,将发送系统运行信息到此邮件。',	

	'setting_email_from'				=>'商城电子邮件寄件人：',
    'setting_email_from_desc'			=>'向商城顾客发送邮件时，显示在邮件中的邮件寄件人。',
    
	'setting_email_transport'			=>'电子邮件寄信方式：',
    'setting_email_transport_desc'		=>'定义使用本地主机(Unix-like) sendmail 或经由 TCP/IP 连接的网路 SMTP 主机送信<br>如果您的服务器运行在类Unix 平台下，请选择 sendmail，如果您的服务器是运行在 Windows 或是 MacOS 平台下，请选择为 smtp，如果使用第三方服务器发信，请选 other。',

	'setting_email_smtp_host'			=>'win32平台下，SMTP 服务器 名称：',

	'setting_email_smtp_port'			=>'win32平台下，SMTP 服务器 端口：',
	'setting_email_smtp_port_desc'		=>' 默认为 25 ，一般情况下不需修改。',

	'setting_email_othor_host'			=>'第三方服务器，服务器 名称：',

	'setting_email_othor_port'			=>'第三方服务器，服务器 端口：',
	'setting_email_othor_port_desc'		=>' 默认为 25 ，一般情况下不需修改。',

	'setting_email_othor_auth'			=>'第三方服务器，是否需要 AUTH LOGIN 验证：',
	'setting_email_othor_auth_desc'		=>'true=是, false=否。',

	'setting_email_othor_from'			=>'第三方服务器，发信人地址：',
	'setting_email_othor_from_desc'		=>'如果需要验证,必须为本服务器地址',

	'setting_email_othor_username'		=>'第三方服务器，用户名：',
	'setting_email_othor_username_desc'	=>'如果需要验证,必须输入 用户名',

	'setting_email_othor_password'		=>'第三方服务器，密码：',
	'setting_email_othor_password_desc'	=>'如果需要验证,必须输入 密码',

	'setting_email_usehtml'				=>'使用 HTML 格式发送电子邮件：',
    'setting_email_usehtml_desc'		=>'发送 HTML 格式的电子邮件.效果为漂亮的网页。',	

	'setting_sendmail_createorder'		=>'订单生成时发送电子邮件：',
    'setting_sendmail_createorder_desc'	=>'订单生成时是否发送电子邮件，ture 为发送，false 为不发送。',    
 	'setting_sendmail_cancelorder'		=>'取消订单时发送电子邮件：',
    'setting_sendmail_cancelorder_desc'	=>'取消订单时是否发送电子邮件，ture 为发送，false 为不发送。',    
 	'setting_sendmail_createaccount'	=>'会员注册成功时发送电子邮件：',
    'setting_sendmail_createaccount_desc'=>'会员注册成功时是否发送电子邮件，ture 为发送，false 为不发送。', 
    
	'setting_gzip_compression'			=>'使用 GZip 压缩输出网页：',
    'setting_gzip_compression_desc'		=>'将页面内容以 gzip 压缩后传输，可以加快传输速度，但会加重服务器的负担。需 PHP 4.0.4 以上且支持 Zlib 模块才能使用。',
    
	'setting_gzip_level'				=>'GZip 压缩等级：',
    'setting_gzip_level_desc'			=>'使用的压缩等级 0-9 (0 = 最小, 9 = 最大).。',
    
	'setting_display_pageparseinfo'		=>'显示系统运行信息：',
    'setting_display_pageparseinfo_desc'=>'显示页面解析时间，数据库查询次数。',
    
	'setting_stock_check'				=>'检查并计算库存量：',
    'setting_stock_check_desc'			=>'检查商品库存量,并自动计算库存。如库存不足不可结帐。',
	  
	'setting_stock_limitshow'			=>'显示库存不足商品：',
    'setting_stock_limitshow_desc'		=>'商品库存不足，仍可显示，但不可结帐。<br />注意：只有当"检查并计算库存量"设为“true”时，此选项才有效。',
    
    'setting_stock_limitsign'			=>'缺货标示 ：',
    'setting_stock_limitsign_desc'		=>'顾客购买数量超过商品库存数量时会显示这个标示，让顾客知道这个商品库存不足或已缺货。',

	'setting_index_new_productid'		=>'首页新到商品显示的商品ID：',
    'setting_index_new_productid_desc'	=>'首页新到商品显示的商品ID，请依次将要在首页显示的新到商品ID输入，ID之间用","隔开<br>商品显示时将按照此顺序显示，不足的商品系统将自动补全，例："23,46,78"。',

	'setting_index_s_productid'			=>'首页特价商品显示的商品ID：',
    'setting_index_s_productid_desc'	=>'首页特价商品显示的商品ID，请依次将要在首页显示的特价商品ID输入，ID之间用","隔开<br>商品显示时将按照此顺序显示，不足的商品系统将自动补全，例："23,46,78"。',

	'setting_index_newsshownum'			=>'首页新闻显示的个数：',
    'setting_index_newsshownum_desc'	=>'',


	'setting_create_smallimage'		=>'上传图片生成缩略图：',
    'setting_create_smallimage_desc'	=>'需要服务器安装GD库,才能打开，具体信息请打开后台首页。',
    
	'setting_orders_savetime'			=>'未付款订单保留时间：',
    'setting_orders_savetime_desc'		=>'未付款订单或付款不足订单保留时间,0 为永久保留不删除,20表示保存20个小时,以此计算。',

	'setting_user_checknum_inheader'	=>'商城前台使用验证码功能', 
	'setting_user_checknum_inheader_desc'=>'商城前台(用户登陆，用户注册等)使用验证码功能。<br>ture 为使用，false 为不使用。',

	'setting_user_checknum_infooter'	=>'商城后台使用验证码功能', 
	'setting_user_checknum_infooter_desc'=>'商城后台(管理员登陆)使用验证码功能。<br>ture 为使用，false 为不使用。',

	'setting_picture_savepath'			=>'商品图片及其它附件保存方式：',
    'setting_picture_savepath_desc'				=>'本设置只对新上传的图片或附件起作用，设置改变之前的图片或附件仍保存在原的来地方。如使用非默认的保存方式，请确认 mkdir()  函数可正常使用，否则图片或附件将无法上传成功。',
	'setting_picture_savepath_default'	=>'默认（将图片存入特定的目录）',
	'setting_picture_savepath_byday'	=>'按天存入不同的目录',

	'setting_store_style'				=>' 商城风格 ：',
    'setting_store_style_desc'			=>'',
    
	'setting_date_format'				=>' 日期格式 ：',
    'setting_date_format_desc'			=>'使用 yyyy(yy) 表示年，mm 表示月，dd 表示天。如 yyyy-mm-dd 可显示为 2006-03-03，yyyy年mm月dd日 可显示为 2006年03月01日',
    
	'setting_smallimage_width'			=>'小图片宽度(像素)：',
    'setting_smallimage_width_desc'		=>'产品列表页面里显示的图片宽度',
    
	'setting_smallimage_height'			=>'小图片高度(像素)：',
    'setting_smallimage_height_desc'	=>'产品列表页面里显示的图片高度',

	'setting_smallimage_width2'			=>'中图片宽度(像素)：',
    'setting_smallimage_width2_desc'	=>'产品详细页面里显示的图片宽度',
    
	'setting_smallimage_height2'		=>'中图片高度(像素)：',
    'setting_smallimage_height2_desc'	=>'产品详细页面里显示的图片高度',
	
	'setting_header_classnum'			=>'页面上部分类横排显示个数：',
    'setting_header_classnum_desc'		=>'如果一级分类数比较多，则会超出表格宽度，可以设置此数值，控制一级分类在页面上部横排显示的个数。',
   
	'setting_reviews_shownum'			=>'商品评论每页显示个数：',
    'setting_reviews_shownum_desc'		=>'',
    
	'setting_productlist_numofrow'		=>'商品列表每页显示行数：',
    'setting_productlist_numofrow_desc'	=>'商品列表包括：商品分类，最新商品，特价商品等，<br>为 0 则为默认。',
    
	'setting_index_newproductnumofrow'	=>'首页最新商品显示的行数：',
    'setting_index_newproductnumofrow_desc'=>'首页新上市商品显示的行数，为 0 则表示商城首页不显示新上市商品',
    
	'setting_index_sproductnumofrow'	=>'首页特价商品显示的行数：',
    'setting_index_sproductnumofrow_desc'=>'首页特价商品显示的行数，为 0 则表示商城首页不显示特价商品',
    
	'setting_index_productnumarow'		=>'首页每行显示的商品数：',
    'setting_index_productnumarow_desc'	=>'包括新上市商品，特价商品，推荐商品，为 0 则为默认',
    
	'setting_gbook_numofrow'			=>'留言板每页显示个数：',
    'setting_gbook_numofrow_desc'		=>'',
    
	'setting_show_country'				=>'是否显示地区中的国家：',
    'setting_show_country_desc'			=>'',

	'setting_country_default'			=>'默认显示的国家：',
    'setting_country_default_desc'		=>'',

	'setting_show_qq'					=>'是否显示QQ：',
    'setting_show_qq_desc'				=>'会员资料里是否显示会员的 QQ 信息。',

	'setting_show_msn'					=>'是否显示MSN：',
    'setting_show_msn_desc'				=>'会员资料里是否显示会员的 MSN 信息。',

	'setting_default_discount'			=>'商城默认商品折扣：',
    'setting_default_discount_desc'		=>'会员未登陆时显示的商品折扣。',

   	'setting_customer_mark'				=>'会员积分折扣：',
    'setting_customer_mark_desc'		=>'是否开启会员积分折扣',

	'setting_nt_tomark'					=>'消费多少金额可累积一个积分：',
    'setting_nt_tomark_desc'			=>'以元为单位计算，10表示消费10元可累积一个积分。',

	'setting_user_leavepay'				=>'使用账户余额功能：',
    'setting_user_leavepay_desc'		=>'当用户退货，或多支付了货款，那么可以将这些款项放入顾客的账户中，在顾客下次购物时，可作为货款使用，但由于其存在无法预测的安全性，我们不推荐使用此功能，由此造成的任何问题（包括经济损失）我们概不负责。',

	'setting_user_lossremark'			=>'使用缺货登记功能：',
    'setting_user_lossremark_desc'		=>'如果有顾客想要购买一件商品，而在商城里没有或是缺货，那么可以允许顾客将此商品信息提交给商城。',

	'setting_seo_title'					=>'商城名称附加词：',
    'setting_seo_title_desc'		=>'网页标题（商城名称）通常是搜索引擎关注的重点，本附加字设置将出现在标题中商城名称的后面，如果有多个关键字，建议用 "|"、","(不含引号) 等符号分隔。',

	'setting_seo_keywords'				=>'Meta Keywords:',
    'setting_seo_keywords_desc'			=>'Keywords 页面头部的 Meta 标签中的一种类型，用于记录本网页里的关键字，多个关键字间请用半角逗号 "," 隔开。',
	
	'setting_seo_description'			=>'Meta Description:
',
    'setting_seo_description_desc'		=>'Description 页面头部的 Meta 标签中的一种类型，用来对本页面的进行描述。',

	'setting_seo_othor'					=>'其他的网页头部信息:',
    'setting_seo_othor_desc'			=>'如需在 &lt;head&gt;&lt;/head&gt;  中添加其他的 头部信息 ，请写成 html 代码。',


);


?>
