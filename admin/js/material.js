var init_item = 2;
$(function() {
  $(".btn-submit-video,.btn-submit-audio,.btn-submit-image").click(function() {
    var type = $(this).attr("ltype");
    var media = $("#m_" + type).val();
    var title = $("#form-" + type + " #m_" + type + "_title").val() != undefined ? $("#form-" + type + " #m_" + type + "_title").val() : '';
    var introduce = $("#form-" + type + " #m_" + type + "_introduce").val() != undefined ? $("#form-" + type + " #m_" + type + "_introduce").val() : '';
    $.ajax({
      data: "act=material_add&type=" + type + "&media=" + media + "&title=" + title + "&introduce=" + introduce,
      url: "wx_ajax.php",
      type: "post",
      dataType: "json",
      success: function(res) {
        if (res.err == 'n') {
          $("#list-" + type + " li").remove();
          $("#list-" + type).html(res.list);
          alert('素材添加成功!')
        } else {
          alert(res.msg)
        }
      },
      error: function() {
        alert('列表刷新失败，请稍后重试！')
      }
    })
  });
  $(".btn-refresh").click(function() {
    var type = $(this).attr("ltype");
    $.ajax({
      data: "act=material_refresh&type=" + type,
      url: "wx_ajax.php",
      type: "post",
      dataType: "json",
      success: function(res) {
        if (res.err == 'n') {
          $("#list-" + type + " li").remove();
          $("#list-" + type).html(res.list)
        } else {
          alert(res.msg)
        }
      },
      error: function() {
        alert('刷新失败，请稍后重试！')
      }
    })
  });
  $(".checkall").click(function() {
    var type = $(this).attr("ltype");
    if ($(this).prop("checked")) {
      $("#list-" + type + " li input[type=checkbox]").prop("checked", true)
    } else {
      $("#list-" + type + " li input[type=checkbox]").prop("checked", false)
    }
  });
  $(".btn-delall").click(function() {
    var type = $(this).attr("ltype");
    var ids = '';
    $("#list-" + type + " li input[type=checkbox]").each(function() {
      if ($(this).prop("checked")) {
        ids += $(this).val() + ','
      }
    });
    $.ajax({
      data: "act=materials_del&type=" + type + "&ids=" + ids,
      url: "wx_ajax.php",
      type: "post",
      dataType: "json",
      success: function(res) {
        if (res.err == 'n') {
          $("#list-" + type + " li").remove();
          $("#list-" + type).html(res.list)
        } else {
          alert(res.msg)
        }
      },
      error: function() {
        alert('删除失败，请稍后重试！')
      }
    })
  })
})
$(document).on("click", ".btn-del", function() {
  var type = $(this).attr("ltype");
  var data = $(this).attr("data");
  if (confirm('您确定要删除该素材吗?')) {
    $.ajax({
      data: data,
      url: "wx_ajax.php",
      type: "post",
      dataType: "json",
      success: function(res) {
        if (res.err == 'n') {
          $("#list-" + type + " li").remove();
          $("#list-" + type).html(res.list)
        } else {
          alert(res.msg)
        }
      },
      error: function() {
        alert('删除失败，请稍后重试！')
      }
    })
  } else {
    return false
  }
});