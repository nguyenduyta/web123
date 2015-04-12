/*
    Như ơ bài trước chúng ta đã tìm hiểu đôi nét tổng quan về sencha extjs. Qua đó giúp chúng ta hiểu được sencha ext được dùng để làm gì 
    vậy sencha extjs được dùng như thế nào thì ở bài viết này chúng ta cùng làm một ví dụ cụ thể để hiểu được sencha ext js được viết như thế nào
    
    Tải thư viện sencha extjs về
    - Đầu tiên các bạn tải thư viện của sencha extjs về tại đây
    - Các bạn lấy ra các thư mục và các file như bên dưới và past vào thư mục có tên là extjs
       - extjs
          - resources
          - ext-all.js
    
    Tạo cấu trúc thư mục
        - helloworld
           - app
              - controller
              - model
              - view
              - store
           - extjs
           - app.js
           - index.html
           
    helloworld: Là thư mục ứng dụng của bạn
    app: là thư mục chứa chứa controller,model,view và một số thư mục khác. Nó được tổ chức theo mô hình MVC
    extjs: Là thư mục chưa thư viện sencha extjs
    app.js: Là file ứng dụng chứa code của bạn
    
    File app.js
    - Các bạn mở file app.js lên chúng ta chép vào đoạn mã như bên dưới
     <!--Code-->
    Để khởi tạo một ứng dụng với sencha ext js chúng ta bắt đầu với từ khóa 
    Ext.application({
        //Here code    
    })
    Chúng ta cùng tìm hiểu các tham số bên trong
    name: Dịnh nghĩa tên của ứng dụng
    appFolder: Thư mục của ứng dụng
    launch : là hàm sẽ tự động chạy khi trang web được load
    Ext.create(): Được dùng để gọi Viewport. Ứng dụng sẽ tự động kiểm tra xem Ext.container.Viewport
    có tồn tại hay không ? nếu không tồn tai nó sẽ gọi container mặc định của senchaextjs
    layout: Kiểu layout trong sencha extjs va trong truong hop nay la kieu fit
    items: Bao gom cac thuoc tinh cua layout do như:
    xtype: 'panel'
    title: Tieu đề cho layout đó
    html: la nội dung được hiển thị ra trình duyệt
    Vì ở bài viết này chúng ta chỉ làm ví dụ đơn giản nên vẫn chưa cần dùng đến controller, model, view 
    File index.html
    Trong file htlm các bạn gọi các file css và các file js vào như bên dưới
    <!DOCTYPE HTML>
    <head>
        <title>Chuongs trinh sencha extjs dau tien</title>
    	<meta http-equiv="content-type" content="text/html" />
    	<meta name="author" content="HTKHOI" />
        <link rel="stylesheet" type="text/css" href="extjs/resources/css/ext-all.css" />
        <script type="text/javascript" src="extjs/ext-all.js"></script>
        <script type="text/javascript" src="app.js"></script>
    </head>
    <body>
    </body>
    </html>
    
*/
Ext.application({
    name: 'HE',
    appFolder: 'app',
    launch:function(){
        Ext.create('Ext.container.Viewport',{
            layout:'fit',
            items:[
                {
                    xtype: 'panel',
                    title:'Chuong trinh sencha EXTJS dau tien',
                    html: 'Hello world'   
                }
            ]
        })   
    }
})