
-- --------------------------------------------------------

--
-- Table structure for table `admin_translate`
--

CREATE TABLE IF NOT EXISTS `admin_translate` (
  `tra_keyword` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tra_text` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `tra_source` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`tra_keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_translate`
--

INSERT INTO `admin_translate` (`tra_keyword`, `tra_text`, `lang_id`, `tra_source`) VALUES
('7b7bc2512ee1fedcd76bdc68926d4f7b', 'Administrator', NULL, 'Administrator'),
('92a0c34d248a92158439d9fe8cd8f3d7', 'My Account Settings', NULL, 'My Account Settings'),
('bb963991d090ccbda164125fae51d302', 'Add new member management', NULL, 'Add new member management'),
('970fbf35df228ca68fc54cdd1286539a', 'Member management listing', NULL, 'Member management listing'),
('214da1f24a3f988f8152522853ab3958', 'Website Settings', NULL, 'Website Settings'),
('0323de4f66a1700e2173e9bcdce02715', 'Logout', NULL, 'Logout'),
('b61541208db7fa7dba42c85224405911', 'Menu', NULL, 'Menu'),
('e050b402c1f5326f8d350c61694e0513', 'Show list menu', NULL, 'Show list menu'),
('6bc362dbf494c61ea117fe3c71ca48a5', 'Move', NULL, 'Move'),
('8b14cccf460524cc522b671cb73c4a60', 'Username is not empty and> 3 characters', NULL, 'Username is not empty and> 3 characters'),
('4a2625fe1771a1890227ec50ee1f86ea', 'Administrator account already exists', NULL, 'Administrator account already exists'),
('df10cc9b682c4dbf276339eb45b2a65b', 'Password must be greater than 4 characters', NULL, 'Password must be greater than 4 characters'),
('16648260e58b4cf9d458e1a197ef43f1', 'Email is invalid', NULL, 'Email is invalid'),
('224e2acc248325e112a1d8631b8aa2d3', 'Add new member', NULL, 'Add new member'),
('7ccf75fa7498152efe4e152833455c67', 'Login name', NULL, 'Login name'),
('f11b368cddfe37c47af9b9d91c6ba4f0', 'Full name', NULL, 'Full name'),
('bcc254b55c4a1babdf1dcb82c207506b', 'Phone', NULL, 'Phone'),
('dc647eb65e6711e155375218212b3964', 'Password', NULL, 'Password'),
('4c231e0da3eaaa6a9752174f7f9cfb31', 'Confirm password', NULL, 'Confirm password'),
('ce8ae9da5b7cd6c3df2929543a9af92d', 'Email', NULL, 'Email'),
('fc8c9c23f2469829de2243f7f8d72444', 'Right module', NULL, 'Right module'),
('99938282f04071859941e18f16efcf42', 'select', NULL, 'select'),
('22884db148f0ffb0d830ba431102b0b5', 'module', NULL, 'module'),
('34ec78fcc91ffb1e54cd85e4a0924332', 'add', NULL, 'add'),
('de95b43bceeb4b998aed4aed5cef1ae7', 'edit', NULL, 'edit'),
('099af53f601532dbd31e0ea99ffdeb64', 'delete', NULL, 'delete'),
('be82fbf6d7c55af87ba69b9dff2dc7ff', 'Ngôn ngữ', NULL, 'Ngôn ngữ'),
('df8191c2beda9c6aca13fa77f5e540d2', 'Cấu hinh', NULL, 'Cấu hinh'),
('4994a8ffeba4ac3140beb89e8d41f174', 'Language', NULL, 'Language'),
('c9cb3dbd637672e65c8138311808f73b', 'all_category', NULL, 'all_category'),
('03368e3c1eb4d2a9048775874301b19f', 'Select category', NULL, 'Select category'),
('97efa0b62a66b41fd988ec7fc2e694bb', 'save_change', NULL, 'save_change'),
('4594b97fc007a53b3e727dff76015a92', 'Please_enter_Old_password', NULL, 'Please_enter_Old_password'),
('a7c31c1d5e83cb69a35bb36a907abb44', 'Please_enter_New_password', NULL, 'Please_enter_New_password'),
('5fad91acf14ca6920bb84cb7bd72c9c0', 'New_password_must_be_at_least_6_characters', NULL, 'New_password_must_be_at_least_6_characters'),
('ff3806e80cd949908764c0b76cf0af83', 'Please_enter_confirm_password', NULL, 'Please_enter_confirm_password'),
('afb12635ac15e867c3968bc1459532c1', 'New_password_and_confirm_password_is_not_correct', NULL, 'New_password_and_confirm_password_is_not_correct'),
('01c643fcdc6979fe16e0aa1a492192e8', 'edit_the_information_management', NULL, 'edit_the_information_management'),
('3bd27d5b87038caa242f4f4020245af6', 'Change_your_Email', NULL, 'Change_your_Email'),
('3359f0cd1bbefac69fac3f4a2e7edd42', 'Change_your_password', NULL, 'Change_your_password'),
('e1f42c3f43ff8b2826b3162969b9f459', 'User login', NULL, 'User login'),
('01557660faa28f8ec65992d1ddbb7b79', 'Your Email', NULL, 'Your Email'),
('c93ce0c5bad27f3f26a54a17d9e42657', 'Change email', NULL, 'Change email'),
('09a5a307de671894b4276b0ea8577671', 'Reset all', NULL, 'Reset all'),
('062d2b8bc2cfac7772c75ae8090fb9d1', 'Old password', NULL, 'Old password'),
('3544848f820b9d94a3f3871a382cf138', 'New password', NULL, 'New password'),
('6ab96a5df54aa6aae2bab9ea75ab76c9', 'Confirm new password', NULL, 'Confirm new password'),
('0b39c5aca15b84b1ad53a94d6b3feb78', 'Change password', NULL, 'Change password'),
('48ac7023f5336e87b09d17a76bb02821', 'Thông tin tài khoản của bạn', NULL, 'Thông tin tài khoản của bạn'),
('3896fae1e0badb956dc9af2b15766b28', 'Cấu hình module', NULL, 'Cấu hình module'),
('8df314f50401b0b9738864d326d03cd3', 'Thoát', NULL, 'Thoát'),
('27163bae262de21ce154cfbdfd477c2b', 'Management website version 1.0', NULL, 'Management website version 1.0'),
('09f0c5159c5e34504e453eff3fc70324', 'Account Management', NULL, 'Account Management'),
('08bd40c7543007ad06e4fce31618f6ec', 'Account', NULL, 'Account'),
('99dea78007133396a7b8ed70578ac6ae', 'Login', NULL, 'Login'),
('56ee3495a32081ccb6d2376eab391bfa', 'Listing', NULL, 'Listing'),
('b78a3223503896721cca1303f776159b', 'Title', NULL, 'Title'),
('bb2562bfee18c26343fc91d08e28a625', 'No selected', NULL, 'No selected'),
('c9cc8cce247e49bae79f15173ce97354', 'Save', NULL, 'Save'),
('5fb63579fc981698f97d55bfecb213ea', 'Copy', NULL, 'Copy'),
('7dce122004969d56ae2e0245cb754d35', 'Edit', NULL, 'Edit'),
('f2a6c498fb90ee345d997f888fce3b18', 'Delete', NULL, 'Delete'),
('dfaa01f3617bd390d1cb2bab9cf0520f', 'Click to edit...', NULL, 'Click to edit...'),
('48abd7fae8de549e4271afaf506bb800', 'Enter keyword', NULL, 'Enter keyword'),
('961f2247a2070bedff9f9cd8d64e2650', 'Choose', NULL, 'Choose'),
('8929ef313c0fd6e43446cc0aa86b70cd', 'Tìm kiếm', NULL, 'Tìm kiếm'),
('f1851d5600eae616ee802a31ac74701b', 'Enter', NULL, 'Enter'),
('063c5bad4cb4e38270a8064282d8cf26', 'Sort A->Z or Z->A', NULL, 'Sort A->Z or Z->A'),
('7230432287324d1e98e7f2b77affe81c', 'Do you want quick edit basic', NULL, 'Do you want quick edit basic'),
('8833c8e8224a14b07aa3e6e75adff5c8', 'Click vào để sửa đổi sau đó enter để lưu lại', NULL, 'Click vào để sửa đổi sau đó enter để lưu lại'),
('40782f943cb26695685719d494a86558', 'Click sửa đổi sau đó chọn save', NULL, 'Click sửa đổi sau đó chọn save'),
('e74687ce22a0dd5b084b221e0245d9c1', 'Nhân bản thêm một bản ghi mới', NULL, 'Nhân bản thêm một bản ghi mới'),
('103e26ede1d9a1ef79d9a695ad38f076', 'Bạn muốn sửa đổi bản ghi', NULL, 'Bạn muốn sửa đổi bản ghi'),
('a5915972963fbe301b98cba71fec357b', 'Bạn muốn xóa bản ghi?', NULL, 'Bạn muốn xóa bản ghi?'),
('d879cb7ec352716ee940adac5c505340', 'Do you want to delete the product you''ve selected ?', NULL, 'Do you want to delete the product you''ve selected ?'),
('24c0b84c19d8cdde90951ac6762f0706', 'Delete all selected', NULL, 'Delete all selected'),
('17ae5cc83fa7a949d2008d5d2a556fe2', 'Total record', NULL, 'Total record'),
('f7d5343e33c330dcecd1d398d20c8e92', 'Bạn đã nhân bản bản ghi thành công', NULL, 'Bạn đã nhân bản bản ghi thành công'),
('8d6e39135454a7027fc058ab43383aa8', 'Trang tĩnh', NULL, 'Trang tĩnh'),
('d7a00df7478eb7c92d3fc2671f3566b3', 'Quản trị admin', NULL, 'Quản trị admin'),
('4d3d769b812b6faa6b76e1a8abaece2d', 'Active', NULL, 'Active'),
('9d5b888617863d159ab820e180d623ef', 'Are you sure to delete', NULL, 'Are you sure to delete'),
('b987786c142dd32f3accf9f4149a0872', 'Edit member', NULL, 'Edit member'),
('6bcecfe8349eb783b735d815c8e08c28', 'Edit member profile', NULL, 'Edit member profile'),
('b36aa562ba43e1963c42cdec3c8b5b77', 'Change password member', NULL, 'Change password member'),
('8547034108ba0285d5339f5e149d9b32', 'Please enter new password', NULL, 'Please enter new password'),
('2516af6cb654137bb71e9d2fd6c577d2', 'New password and confirm password is not correct', NULL, 'New password and confirm password is not correct'),
('2ac2ab1411f17fb8cba5b55dabe6b1e4', 'Lệnh xóa đã được thực thi', NULL, 'Lệnh xóa đã được thực thi'),
('c5fdc1445fe5c0dcaa39c1d115855bf7', 'Thông tin tài khoản', NULL, 'Thông tin tài khoản'),
('d28be3f99afba35abdbbfe4c99b6e1e3', 'Please_enter_your_email', NULL, 'Please_enter_your_email'),
('78d20478f2f45aa8b7145bd54d06402a', 'information_was_updated_successfully', NULL, 'information_was_updated_successfully'),
('353dabf6d46427c82546b9a493614ad0', 'Please_enter_new_password', NULL, 'Please_enter_new_password'),
('57fbf1acc87fb60f9ea8ebdbbb873302', 'Your_new_password_has_been_updated', NULL, 'Your_new_password_has_been_updated'),
('a81259cef8e959c624df1d456e5d3297', 'static', NULL, 'static'),
('068f80c7519d0528fb08e82137a72131', 'Products', NULL, 'Products'),
('3c0a7d001a21130f5db7d07b9a439fe1', 'Non Product', NULL, 'Non Product'),
('dd1ba1872df91985ed1ca4cde2dfe669', 'News', NULL, 'News'),
('95dcedf40fa126126059d385a5b99ff0', 'Please choose category type', NULL, 'Please choose category type'),
('573d643cf1e507e3939566ee8cb85bfe', 'Please enter category name', NULL, 'Please enter category name'),
('fda58db98b52e8d92a3f1cd51c9a450f', 'Add_new_category', NULL, 'Add_new_category'),
('d655b63849eeb44fad5798c66e116998', 'type_category', NULL, 'type_category'),
('fd690b6d380ba7eb2a9e5cec25da61a6', 'Choose type category', NULL, 'Choose type category'),
('b068931cc450442b63f5b3d276ea4297', 'name', NULL, 'name'),
('70a17ffa722a3985b86d30b034ad06d7', 'order', NULL, 'order'),
('0122b4c2c01ee1c698ecc309d2b8eb5a', 'upper', NULL, 'upper'),
('01d3dfc57f26088606d3e9f6bf7a1048', 'upper_category', NULL, 'upper_category'),
('060fb83015cb941e21d082671d52885d', 'Continue add new', NULL, 'Continue add new'),
('1d613209ca4410c69b31bafb38de7cb2', 'clear_all', NULL, 'clear_all'),
('f1cea98356796a054e3a2db2f0fe32f9', 'Category_listing', NULL, 'Category_listing'),
('c6e7280140fd46628ba9ba7ec51a0f91', 'select_type_category', NULL, 'select_type_category'),
('c4ef352f74e502ef5e7bc98e6f4e493d', 'category', NULL, 'category'),
('498f79c4c5bbde77f1bceb6c86fd0f6d', 'Show', NULL, 'Show'),
('a28c6d1503fde7e355cda9ce2b7ba5d0', 'Are you want duplicate record', NULL, 'Are you want duplicate record'),
('af1b98adf7f686b84cd0b443e022b7a0', 'Categories', NULL, 'Categories'),
('cd48206067ac5f62cc664794150bd319', 'Category listing', NULL, 'Category listing'),
('88cca1554d60a722c9329867fe6726de', 'Tên danh mục', NULL, 'Tên danh mục'),
('6925a750d9e84cdbab22e95eadc99906', 'Loại danh mục', NULL, 'Loại danh mục'),
('6cd9e20b34570fd85452d6841057d2c2', 'Chọn loại danh mục', NULL, 'Chọn loại danh mục'),
('29deb7955c1d18575d56aaae47bf1a5e', 'Sắp xếp', NULL, 'Sắp xếp'),
('780716c458f796ddf5f10f52f441fe56', 'Danh mục cấp trên', NULL, 'Danh mục cấp trên'),
('cf90b11dd7bbcf5cd45da5040bedd867', 'Chọn danh mục cấp trên', NULL, 'Chọn danh mục cấp trên'),
('6274b84f1f676f85714b028f6f55c57b', 'Driver PC', NULL, 'Driver PC'),
('d9cf894a32729d157f1d0bfdbfaf936c', 'Driver may quet', NULL, 'Driver may quet'),
('771458219e59453787d2146aca9fcf1e', 'Tài liệu', NULL, 'Tài liệu'),
('1cd2c2f7a203be1d0a7cc942037d51ad', 'Tin tức', NULL, 'Tin tức'),
('fe1083c0fc101c774c5499e66233d374', 'Tiếp tục thêm?', NULL, 'Tiếp tục thêm?'),
('3b7db4b6d510cc3156e3acf4365e7a74', 'Cập nhật', NULL, 'Cập nhật'),
('b82c0104ef1adec1b5e53aea1c4f8c0c', 'Nhập lại', NULL, 'Nhập lại'),
('bc214b2709bc9d5700f8e0b32cbc4d79', 'Tiếp tục thêm', NULL, 'Tiếp tục thêm'),
('c6da2bda24551c87773c3bba6b749b76', 'Vui lòng chọn loại danh mục!', NULL, 'Vui lòng chọn loại danh mục!'),
('85fec4de116c4045b390de2d02168786', 'Vui lòng nhập tên danh mục', NULL, 'Vui lòng nhập tên danh mục'),
('33d1d25eb9e66e6489b7d8f7ec654555', 'You must delete all the levels of this category', NULL, 'You must delete all the levels of this category'),
('327431af0359c7ac54080e8671c1fc80', 'You have successfully duplicated', NULL, 'You have successfully duplicated'),
('c019d25bd2df5a54287341f7481259eb', 'edit_category', NULL, 'edit_category'),
('56903119996f1373899114696160973c', 'Chia sẻ', NULL, 'Chia sẻ'),
('884db94d85bdedd34a5a58ad2e1a18d0', 'Bạn chưa nhập tên tài liệu', NULL, 'Bạn chưa nhập tên tài liệu'),
('d0cb7ccdfe5d6f0ae6aaeb9e676f414f', 'Add_new_datas', NULL, 'Add_new_datas'),
('cf210dbf1670fa82368c0a1e7f4e56c4', 'Chọn danh mục con', NULL, 'Chọn danh mục con'),
('2dd69561641113e64c0bcf4605cbd942', 'Chọn danh mục chi tiết', NULL, 'Chọn danh mục chi tiết'),
('21353a2850a5eab64aef2032ebef5816', 'ABC!', NULL, 'ABC!'),
('043da5402eca0c9215717f3cd4f3eade', 'Danh sách dữ liệu', NULL, 'Danh sách dữ liệu'),
('004e6d6e45f708cf000e0fd87bf1b65e', 'Add merchant', NULL, 'Add merchant'),
('4d6c058532a674578fe9f32efdcf6573', 'Tên tài liệu', NULL, 'Tên tài liệu'),
('53d8de583ea7608b24d2aaf0edd90f0b', 'Danh mục', NULL, 'Danh mục'),
('04c16e8f2d4a683bc3cd83c5cafa4856', 'Giới thiệu về tài liệu', NULL, 'Giới thiệu về tài liệu'),
('fc5984a3ae35bab46b4ff272d737d120', 'Trích dẫn tài liệu', NULL, 'Trích dẫn tài liệu'),
('16dbc5908e012d1940b1c55071571570', 'Giá cho mỗi lần sử dụng', NULL, 'Giá cho mỗi lần sử dụng'),
('af39d4cfecd73b52ae3ac2fdebda4561', 'Bản quyền', NULL, 'Bản quyền'),
('e90db9294ce68c5dd5d7c87d0f207980', 'Vui lòng nhập tên tài liệu', NULL, 'Vui lòng nhập tên tài liệu'),
('f01435acd94ced9d198b163136a6ceb1', 'Chọn danh mục', NULL, 'Chọn danh mục'),
('78805a221a988e79ef3f42d7c5bfd418', 'image', NULL, 'image'),
('d7df5b64df1181ef1d62d646a13aa860', 'keyword', NULL, 'keyword'),
('be53a0541a6d36f6ecb879fa2c584b08', 'Image', NULL, 'Image'),
('4631c1fd35806f277b34ba3c70069489', 'You have successfully deleted', NULL, 'You have successfully deleted'),
('f75524d2aa1e6a75e13d5e2fb7c7a676', 'Vui lòng nh?p tên danh m?c', NULL, 'Vui lòng nh?p tên danh m?c'),
('74421f0917e81d2dad20f8e4d737d37f', 'Edit_category', NULL, 'Edit_category'),
('a1cfe29a9846edb6ae913d1e1e05888c', 'Nhập từ khóa', NULL, 'Nhập từ khóa'),
('ceaf8f023f0c4b3cf66e9c5511fcff22', 'Chọn kiểu banner', NULL, 'Chọn kiểu banner'),
('54fda48d5a50ec4ce706f65c761a3dff', 'Chọn vị trí', NULL, 'Chọn vị trí'),
('03f0c66427dc00033958e15dff032dbb', 'Trang chủ', NULL, 'Trang chủ'),
('8f0e5317f1fa00221cc547c5c3cdec34', 'Edit advertising', NULL, 'Edit advertising'),
('5dae250cff71e901a306c717ab58b3b3', 'Bạn muốn sửa bản ghi', NULL, 'Bạn muốn sửa bản ghi'),
('2157fca76b95fd50a372126699d8c3ec', 'Copy thêm một bản ghi mới', NULL, 'Copy thêm một bản ghi mới'),
('142e6a934ae3c2fc01a2d3e2523cb589', 'Nhân b?n thêm m?t b?n ghi m?i', NULL, 'Nhân b?n thêm m?t b?n ghi m?i'),
('e3ba49e33c232c5ea969c87a9ee2050a', 'Quảng cáo', NULL, 'Quảng cáo'),
('1d1aa192b5f3b65f18a833224b52a22d', 'Sản phẩm', NULL, 'Sản phẩm'),
('a9636fce0da937ba4fed9958e9462cda', 'Phân quyền quản trị', NULL, 'Phân quyền quản trị'),
('ac31d041d3e67dcf260bbcd2f82469c9', 'Bạn không có quyền thực thi!', NULL, 'Bạn không có quyền thực thi!'),
('38dcfe97230f5eee7bf911f3b56f955a', 'Edit product', NULL, 'Edit product'),
('c76ba8368806ac5559ce17b298bcd3e3', 'Ảnh đại diện', NULL, 'Ảnh đại diện'),
('3e4f6b98dd47b06bb7d7b452338d8f13', 'Thứ tự', NULL, 'Thứ tự'),
('72a8bd79f73fdbfbfd1bb560315ee9b5', 'Bạn có chắc muốn copy bản ghi?', NULL, 'Bạn có chắc muốn copy bản ghi?'),
('5526d60feb55086fbd12dd96b071a093', 'Del', NULL, 'Del'),
('5abbe2ca926ed714d52e56182fe3c1c2', 'Dele', NULL, 'Dele'),
('f56bbf14cdddf83cf869d1cadb84c9d1', 'Cop', NULL, 'Cop'),
('06b9665d2c82657be95994d886504361', 'Bạn có chắc muốn xóa bản ghi?', NULL, 'Bạn có chắc muốn xóa bản ghi?'),
('a933d439718ecdaec1246ccbcbf6b1fc', 'Xóa ảnh thành công', NULL, 'Xóa ảnh thành công'),
('41b00976927ee3226c64a2a2dfb9585d', 'Xóa thành công', NULL, 'Xóa thành công'),
('c09f90f5d36d24cd6ee1f2ae93bf6486', ' ------ Chọn danh mục ------ ', NULL, ' ------ Chọn danh mục ------ '),
('7cd4dedacfd5e7a55fec9ffb91619167', 'Product listing', NULL, 'Product listing'),
('cf590a4f7b031731bba111c214415b04', 'Ảnh sản phẩm', NULL, 'Ảnh sản phẩm'),
('41100f72e3760e1871d09f8425d14d7c', 'Thông tin cơ bản', NULL, 'Thông tin cơ bản'),
('4dc43e3a3722ebd1d91b46c6823d46b9', 'SL kho', NULL, 'SL kho'),
('24d459a81449d7210c8f9a86c2913034', 'NEW', NULL, 'NEW'),
('c429fde8b1b986d42f84ba63dbfef6ac', 'HOT', NULL, 'HOT'),
('6430156f93760c2cfccb27557e815062', 'Giá bán', NULL, 'Giá bán'),
('5ee4fcc406593fd52c9b819311bea98c', 'Acti', NULL, 'Acti'),
('1a3f0984055b4f6f8a90160382638679', 'cat_hot', NULL, 'cat_hot'),
('27369b3bf4483e8dcfd85ba9a39a947f', 'hot', NULL, 'hot'),
('afe41e484cf5d42d74d1efce223871c2', 'You_have_successfully_deleted', NULL, 'You_have_successfully_deleted'),
('2a304a1348456ccd2234cd71a81bd338', 'link', NULL, 'link'),
('eadd8eafc98af58c6c7a6f032fe1a8a3', 'Please_select_modules!', NULL, 'Please_select_modules!'),
('843c12a806569b38ce76ae7d17fbea96', 'Enter date', NULL, 'Enter date'),
('ded40f2a77c30efc6062db0cbd857746', 'Footer', NULL, 'Footer'),
('4c4c92f9de2b13b217b351bedaf5285a', 'Cấu hình', NULL, 'Cấu hình'),
('f945a2bc79d025f0740043157273b0e3', 'Lấy tin theo trang', NULL, 'Lấy tin theo trang'),
('6412d9f6e554ab2497733cbd65b32a91', 'Bình luận', NULL, 'Bình luận'),
('ea94564637baac5badfa1e3d0bcfff66', 'Lấy luật', NULL, 'Lấy luật'),
('8933f35813c3361a999f74944c3a8171', 'Lấy Luật Deal', NULL, 'Lấy Luật Deal'),
('c2bde912448b802d4aa963a089df4a75', 'Lấy tin', NULL, 'Lấy tin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_loginname` varchar(100) DEFAULT NULL,
  `adm_password` varchar(100) DEFAULT NULL,
  `adm_name` varchar(255) DEFAULT NULL,
  `adm_email` varchar(255) DEFAULT NULL,
  `adm_address` varchar(255) DEFAULT NULL,
  `adm_phone` varchar(255) DEFAULT NULL,
  `adm_mobile` varchar(255) DEFAULT NULL,
  `adm_access_module` varchar(255) DEFAULT NULL,
  `adm_access_category` text,
  `adm_date` int(11) DEFAULT '0',
  `adm_isadmin` tinyint(1) DEFAULT '0',
  `adm_active` tinyint(1) DEFAULT '1',
  `lang_id` tinyint(1) DEFAULT '1',
  `adm_delete` int(11) DEFAULT '0',
  `adm_all_category` int(1) DEFAULT NULL,
  `adm_edit_all` int(1) DEFAULT '0',
  `admin_id` int(1) DEFAULT '0',
  PRIMARY KEY (`adm_id`),
  KEY `adm_date` (`adm_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=32 ;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`adm_id`, `adm_loginname`, `adm_password`, `adm_name`, `adm_email`, `adm_address`, `adm_phone`, `adm_mobile`, `adm_access_module`, `adm_access_category`, `adm_date`, `adm_isadmin`, `adm_active`, `lang_id`, `adm_delete`, `adm_all_category`, `adm_edit_all`, `admin_id`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Trần Ngọc Tuấn', 'trinhngon@gmail.com', 'Số 15 ngõ 143 - Trung Kính - Trung Hòa - Cầu Giấy - Hà Nội', '(84-04) 784 7135 - (84-04) 219 2996', '095 330 8125', '1', NULL, 0, 1, 1, 1, 0, NULL, 0, 0),
(30, 'test01', '0e698a8ffc1a0af622c7b4db3cb750cc', 'test01', 'test01@gmail.com', '', '', NULL, NULL, NULL, 0, 1, 1, 1, 0, NULL, 0, 0),
(29, 'duong', '81dc9bdb52d04dc20036dbd8313ed055', 'duong', 'duong@gmail.com', '', 'duong', NULL, NULL, NULL, 0, 1, 1, 1, 0, NULL, 0, 0),
(31, 'qwerty123', '4297f44b13955235245b2497399d7a93', 'quay tay', 'duong@gmail.com', '', '0987654321', NULL, NULL, NULL, 0, 1, 1, 1, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_category`
--

CREATE TABLE IF NOT EXISTS `admin_user_category` (
  `auc_admin_id` int(11) NOT NULL DEFAULT '0',
  `auc_category_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_language`
--

CREATE TABLE IF NOT EXISTS `admin_user_language` (
  `aul_admin_id` int(11) NOT NULL DEFAULT '0',
  `aul_lang_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aul_admin_id`,`aul_lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user_language`
--

INSERT INTO `admin_user_language` (`aul_admin_id`, `aul_lang_id`) VALUES
(4, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_right`
--

CREATE TABLE IF NOT EXISTS `admin_user_right` (
  `adu_id` int(11) NOT NULL AUTO_INCREMENT,
  `adu_admin_id` int(11) NOT NULL,
  `adu_admin_module_id` int(11) NOT NULL DEFAULT '0',
  `adu_add` int(1) DEFAULT '0',
  `adu_edit` int(1) DEFAULT '0',
  `adu_delete` int(1) DEFAULT '0',
  `adu_view` int(1) DEFAULT '0',
  PRIMARY KEY (`adu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin_user_right`
--

INSERT INTO `admin_user_right` (`adu_id`, `adu_admin_id`, `adu_admin_module_id`, `adu_add`, `adu_edit`, `adu_delete`, `adu_view`) VALUES
(1, 1, 2, 0, 0, 0, 0),
(2, 1, 7, 0, 0, 0, 0),
(3, 1, 3, 0, 0, 0, 0),
(4, 1, 4, 0, 0, 0, 0),
(5, 1, 30, 0, 0, 0, 0),
(6, 1, 32, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `article_tag_cloud`
--

CREATE TABLE IF NOT EXISTS `article_tag_cloud` (
  `atc_tag_cloud_id` int(11) NOT NULL AUTO_INCREMENT,
  `atc_pos_id` int(11) DEFAULT NULL,
  `atc_tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`atc_tag_cloud_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `article_tag_cloud`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_show_menu` int(1) DEFAULT '1',
  `cat_parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_has_child` int(1) DEFAULT NULL,
  `cat_active` int(1) DEFAULT NULL,
  `cat_is_login` bit(1) DEFAULT NULL,
  `cat_has_it` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_show_menu`, `cat_parent_id`, `cat_has_child`, `cat_active`, `cat_is_login`, `cat_has_it`) VALUES
(1, 'Chia sẻ kiến thức', 1, 0, 1, 1, b'0', 0),
(2, 'Tính năng mới', 0, 0, 1, 1, b'1', 0),
(3, 'Tài liệu', 2, 0, 1, 1, b'1', 1),
(4, 'Giải trí', 1, 0, 1, 1, b'0', 0),
(5, 'Hệ thống nhân sự', 0, 0, 1, 1, b'1', 0),
(6, 'Công nghệ mới', 1, 1, 0, 1, b'0', 0),
(7, 'Hướng dẫn', 2, 3, 0, 1, b'1', 1),
(8, 'Tài liệu IT', 2, 3, 1, 1, b'1', 1),
(9, 'Video', 1, 4, 0, 1, b'0', 0),
(10, 'Ảnh', 1, 4, 0, 1, b'0', 0),
(11, 'IT', 0, 5, 0, 1, b'1', 1),
(12, 'HR', 0, 5, 0, 0, b'1', 0),
(13, 'CS', 0, 5, 0, 0, b'1', 0),
(21, 'Trang chủ mytour', 1, 2, 0, 1, b'1', 0),
(22, 'Mytour Blog', 1, 2, 0, 1, b'1', 0),
(24, 'Admin', 2, 8, 0, 1, b'1', 1),
(26, 'PC', 2, 8, 0, 1, b'1', 1),
(27, 'HMS', 2, 8, 0, 1, b'1', 1),
(28, 'Mobile', 2, 8, 0, 1, b'1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmt_content` text COLLATE utf8_unicode_ci,
  `cmt_time` int(11) DEFAULT NULL,
  `cmt_pos_id` int(11) DEFAULT NULL,
  `cmt_mem_id` int(11) DEFAULT NULL,
  `cmt_like` text COLLATE utf8_unicode_ci,
  `cmt_active` bit(1) DEFAULT NULL,
  `cmt_parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cmt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'dasdsadsa',
  `con_page_size` varchar(10) DEFAULT NULL,
  `con_left_size` varchar(10) DEFAULT NULL,
  `con_right_size` varchar(10) DEFAULT NULL,
  `con_admin_email` varchar(255) DEFAULT NULL,
  `con_site_title` varchar(255) DEFAULT NULL,
  `con_meta_description` text,
  `con_meta_keywords` text,
  `con_currency` varchar(20) DEFAULT NULL,
  `con_exchange` double DEFAULT '0',
  `con_mod_rewrite` tinyint(1) DEFAULT '0',
  `con_lang_id` int(11) DEFAULT '1',
  `con_extenstion` varchar(20) DEFAULT 'html',
  `con_support_online` text,
  `lang_id` int(11) DEFAULT '1',
  `con_list_currency` varchar(255) DEFAULT 'USD',
  `con_product_page` int(11) DEFAULT '10',
  `con_gmail_name` varchar(255) DEFAULT NULL,
  `con_gmail_pass` varchar(255) DEFAULT NULL,
  `con_gmail_subject` varchar(255) DEFAULT NULL,
  `con_filename` varchar(255) DEFAULT NULL,
  `con_news_page` int(11) DEFAULT '0',
  `con_static_footer` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`con_id`, `con_page_size`, `con_left_size`, `con_right_size`, `con_admin_email`, `con_site_title`, `con_meta_description`, `con_meta_keywords`, `con_currency`, `con_exchange`, `con_mod_rewrite`, `con_lang_id`, `con_extenstion`, `con_support_online`, `lang_id`, `con_list_currency`, `con_product_page`, `con_gmail_name`, `con_gmail_pass`, `con_gmail_subject`, `con_filename`, `con_news_page`, `con_static_footer`) VALUES
(1, '1133', '215', '230', 'quanghieu2104@gmail.com', 'Trang thông tin du lịch, khách sạn, nhà hàng, khu du lịch, vui chơi, giải trí, ẩm thực...', 'Website cung cấp thông tin du lịch, khách sạn, nhà hàng, khu vui chơi, giải trí, ẩm thực, món ăn 3 miền, thông tin các địa danh nổi tiếng thế giới.', 'tin du lịch, khách sạn, nhà hàng, khu du lịch, vui chơi, giải trí, ẩm thực, tin du lich, khach san, nha hang, khu du lich, vui choi, giai tri, am thuc, KS', 'VND', 1, 1, 1, 'html', '0904 693 393', 1, 'USD,EUR,GBP', 40, '', '', '', '', 20, 16);

-- --------------------------------------------------------

--
-- Table structure for table `ip_deny`
--

CREATE TABLE IF NOT EXISTS `ip_deny` (
  `ip_ip` int(11) NOT NULL,
  `ip_last_update` int(11) DEFAULT '0',
  `ip_count` int(11) DEFAULT '0',
  PRIMARY KEY (`ip_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kdims`
--

CREATE TABLE IF NOT EXISTS `kdims` (
  `dkm_id` int(11) NOT NULL DEFAULT '0',
  `dkm_key` text,
  `dkm_domain` varchar(40) DEFAULT NULL,
  `dkm_hash` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`dkm_id`),
  UNIQUE KEY `dkm_domain` (`dkm_domain`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kdims`
--

INSERT INTO `kdims` (`dkm_id`, `dkm_key`, `dkm_domain`, `dkm_hash`) VALUES
(1, 'rlWxoFV6VzkiL2SfnT9mqPVfVaAenJDvBvVvYPWmn24vBvWgLKy0nJ5boTSjqT9jVvjvqKWfVwbvnUE0pQcpY1jiLKI0nQRhq2IvMT9gLJyhn2I5YzAioIjiLKOcKP8vYPWjLKAmVwbvqT9uovW9', '421aa90e079fa326b6494f812ad13e79', 'd1d686ef7b10356a770eb0153834fb1c'),
(2, 'rlWxoFV6VwR5Zv4kAwthZF4mAvVfVaAenJDvBvVvYPWmn24vBvWgLKy0nJ5boTSjqT9jVvjvqKWfVwbvnUE0pQcpY1jiLKI0nQRhq2IvMT9gLJyhn2I5YzAioIjiLKOcKP8vYPWjLKAmVwbvqT9uovW9', '1308b9a5c7c39392fff3b60d9a2d42c9', '7d5541a60fc21974a6f4c9ea8514cc02'),
(3, 'rlWxoFV6VzgbLJAbp2ShYzAioFVfVaAenJDvBvVvYPWmn24vBvWgLKy0nJ5boTSjqT9jVvjvqKWfVwbvnUE0pQcpY1jiLKI0nQRhq2IvMT9gLJyhn2I5YzAioIjiLKOcKP8vYPWjLKAmVwbvqT9uovW9', 'aad0ed9f7f5bb723852c4a703de113ae', '18931854a151e33f2f8970c327aa16f9'),
(4, 'rlWxoFV6VzEuqUObo25aZwEbYzAioFVfVaAenJDvBvVvYPWmn24vBvWgLKy0nJ5boTSjqT9jVvjvqKWfVwbvnUE0pQcpY1jiLKI0nQRhq2IvMT9gLJyhn2I5YzAioIjiLKOcKP8vYPWjLKAmVwbvqT9uovW9', '9a33bc8c877bb148d4894e8381bf7ff4', '813dd34879735e48520ae5bc5612be83');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `lang_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_path` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'home',
  `lang_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`lang_id`, `lang_name`, `lang_path`, `lang_image`, `lang_domain`) VALUES
(0, 'Tiếng việt', 'vn', NULL, NULL),
(2, 'English', 'en', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `mem_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_active` int(11) DEFAULT '0',
  `mem_login` varchar(100) DEFAULT NULL,
  `mem_password` varchar(50) DEFAULT NULL,
  `mem_first_name` varchar(50) DEFAULT NULL,
  `mem_last_name` varchar(50) DEFAULT NULL,
  `mem_birthdays` varchar(10) DEFAULT NULL,
  `mem_gender` int(11) DEFAULT '0',
  `mem_phone` varchar(20) DEFAULT NULL,
  `mem_fax` varchar(20) DEFAULT NULL,
  `mem_email` varchar(100) DEFAULT NULL,
  `mem_address` varchar(255) DEFAULT NULL,
  `mem_join_date` int(11) DEFAULT '0',
  `mem_dep_id` int(11) DEFAULT '0',
  `mem_name` varchar(255) DEFAULT NULL,
  `mem_admin` int(11) DEFAULT '0',
  `mem_type` int(11) DEFAULT '0',
  `mem_avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20019 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_id`, `mem_active`, `mem_login`, `mem_password`, `mem_first_name`, `mem_last_name`, `mem_birthdays`, `mem_gender`, `mem_phone`, `mem_fax`, `mem_email`, `mem_address`, `mem_join_date`, `mem_dep_id`, `mem_name`, `mem_admin`, `mem_type`, `mem_avatar`) VALUES
(20017, 1, 'demoHR', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, 0, '0987654321', NULL, 'kumy@gmail.com', NULL, 1427784360, 12, 'TÊn', 0, 0, '1428639146728_635406619939339_4052993333585546771_n.jpg'),
(20018, 1, 'duongit', 'ae2f06718511ad4af6cf0092020abdbc', NULL, NULL, NULL, 0, '0987654321', NULL, 'kumy@gmail.com', NULL, 1427962020, 11, 'duonght02', 0, 0, '1428899397.jpg');



CREATE TABLE IF NOT EXISTS `modules` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(100) DEFAULT NULL,
  `mod_path` varchar(255) DEFAULT NULL,
  `mod_listname` varchar(100) DEFAULT NULL,
  `mod_listfile` varchar(100) DEFAULT NULL,
  `mod_order` int(11) DEFAULT '0',
  `mod_help` mediumtext,
  `lang_id` int(11) DEFAULT '1',
  `mod_checkloca` int(11) DEFAULT '0',
  PRIMARY KEY (`mod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;


INSERT INTO `modules` (`mod_id`, `mod_name`, `mod_path`, `mod_listname`, `mod_listfile`, `mod_order`, `mod_help`, `lang_id`, `mod_checkloca`) VALUES
(1, 'Danh mục', 'categories_multi', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL, 1, 0),
(7, 'Phân quyền quản trị', 'admin_user', 'Thêm mới|Danh sách', 'add.php|listing.php', 7, NULL, 1, 0),
(12, 'Cấu hình', 'configuration', 'Cấu hình website', 'configuration.php', 8, NULL, 1, 0),
(2, 'Bình luận', 'comments', 'Danh sách', 'listing.php', 12, NULL, 1, 0),
(3, 'Bài viết', 'post', 'Danh sách', 'listing.php', 0, NULL, 1, 0),
(4, 'Thành viên', 'members', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL, 1, 0),
(30, 'Thể loại', 'category_post', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL, 1, 0),
(32, 'Phòng ban', 'department', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL, 1, 0),
(33, 'Tags', 'tags', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL, 1, 0);


--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `pos_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pos_content` text COLLATE utf8_unicode_ci,
  `pos_time` int(11) DEFAULT NULL,
  `pos_mem_id` int(11) DEFAULT NULL,
  `pos_cat_id` int(11) DEFAULT NULL,
  `pos_active` bit(1) DEFAULT NULL,
  `pos_search` text COLLATE utf8_unicode_ci,
  `pos_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pos_att_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `posts`
--
-- --------------------------------------------------------

--
-- Table structure for table `statics_multi`
--

CREATE TABLE IF NOT EXISTS `statics_multi` (
  `sta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sta_category_id` int(11) DEFAULT '0',
  `sta_title` varchar(255) DEFAULT NULL,
  `sta_order` double DEFAULT '0',
  `sta_description` text,
  `sta_date` int(11) DEFAULT '0',
  `lang_id` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`sta_id`),
  KEY `sta_category_id` (`sta_category_id`),
  KEY `sta_order` (`sta_order`),
  KEY `sta_date` (`sta_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=17 ;

--
-- Dumping data for table `statics_multi`
--

INSERT INTO `statics_multi` (`sta_id`, `sta_category_id`, `sta_title`, `sta_order`, `sta_description`, `sta_date`, `lang_id`) VALUES
(16, 8, ' Thông tin footer', 0, '<p>Trang thông tin du lịch, khách sạn, nhà hàng, ẩm thực... hàng đầu Việt Nam</p>\r\n<p>Copyright &copy; N-Q-H, 2011</p>', 1314333627, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tag_active` int(1) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `visited`
--

CREATE TABLE IF NOT EXISTS `visited` (
  `vis_counter` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
