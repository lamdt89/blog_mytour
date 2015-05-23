$(function() {
	//phân trang index

	page 	= 	$("#next").data("page");
	ipage 	=	$("#next").data("ipage");
	$("#next").click(function(){
		// var that = $(this);
		page++;
		if(page == ipage){
			$("#next").hide();
		}
		$.ajax({
			method: "GET",
			url: "public/views/view_pagination_index.php",
			data: {page: page},
			success: function(data) {
				history.pushState('','','blog-page-'+page);
				
				$("#result").append(data);
				
			}
		});
	});


	//phân trang listing

	cat_id 		= 	$("#lnext").data("catid");
    cat_name 	= 	$("#lnext").data('name');
    server_name	=	$("#lnext").data('server');
	lpage 		= 	$("#lnext").data("lpage");
	t_lpage 	= 	$("#lnext").data("tlpage");
	$("#lnext").click(function(){
		lpage++;
		if(lpage == t_lpage){
			$("#lnext").hide();
		}
		$.ajax({
			method: "GET",
			url: "http://"+server_name+"/public/views/view_pagination_listing.php",
			data: {lpage: lpage, cat_id: cat_id},
			success: function(data) {
                history.pushState('','','http://'+server_name+'/c'+cat_id+'-'+cat_name+'-page-'+lpage);
				
				$("#lresult").append(data);
				
			}
		});
	});	


	// xem thêm comment

	pid 	= 	$("#cnext").data("pid");
	cpage 	= 	$("#cnext").data("cpage");
	t_cpage =	$("#cnext").data("tcpage");
	$("#cnext").click(function(){
		
		cpage++;
		if(cpage == t_cpage){
			$("#cnext").hide();
		}

		$.ajax({
			method: "GET",
			url: "public/views/view_pagination_comment.php",
			data: {cpage: cpage, pid: pid},
			success: function(data) {
				if(data.trim() == ''){
					$("#cnext").hide();
				} else {
					$("#c-result").append(data);
				}
                $('pre code').each(function(i, block) {
                    hljs.highlightBlock(block);
                });
			}
		});
	});


	// phân trang tìm kiếm

	spage = $("#snext").data("spage");
	q = $("#snext").data("q");
	tpage = $("#snext").data("tpage");
	
	$("#snext").click(function(){
		// var that = $(this);
		spage++;
		if(spage == tpage){
			$("#snext").hide();
		}
		$.ajax({
			method: "GET",
			url: "public/views/view_pagination_search.php",
			data: {spage: spage, q: q},
			success: function(data) {
                history.pushState('','','q='+q+'-page-'+spage);
				$(".hidd").hide();
				
				$("#s-result").html(data);
				
				
			}
		});
	});

	$("#sprev").click(function() {
		spage--;
		$.ajax({
			method:"GET",
			url:"public/views/view_pagination_search.php",
			data:{spage: spage, q: q},
			success: function(data) {
                history.pushState('','','q='+q+'-page-'+spage);
				$("#s-result").html(data);
				$("#snext").show();
			}
		});
	});

	$('.button').click(function(){
		$(window).scrollTop(20);
		if(spage > 1){
			$("#sprev").show();
		}
		else{
			$("#sprev").hide();
		}
	})

    //Xóa bài đăng
    $('.delete').click(function(){
        if(confirm('Bạn có chắc chắn muốn xóa')) {
            pos_id = $(this).data("id");
            $.ajax({
                url: 'public/article/delete.php',
                type: 'GET',
                data: {
                    post: pos_id,
                },
                success: function (result) {
                    alert(result);
                    $('#tr-' + pos_id).hide();
                }
            });
        }
    });
});