Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
  el :'#manage-note',
  data :{
    order_menus: [],
    pagination: {
      total: 0,
      per_page: 2,
      from: 1,
      to: 0,
      current_page: 1
    },
    offset: 4,
    formErrors:{},
    formErrorsUpdate:{},
    newnote : {'menu_type':'','menu_plant':'','menu_meal':'','menu_restaurant':'','menu_item':'','menu_money':''},
    fillnote : {'menu_type':'','menu_plant':'','menu_meal':'','menu_restaurant':'','menu_item':'','menu_money':'','id':''}
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },

  
         mounted: function () {

             this.getVuenote(this.pagination.current_page);
         }, 
  methods: {
    getVuenote: function(page) {
      this.$http.get('vueorder_menus?page='+page).then((response) => {

        this.$set(this,'order_menus', response.data.data.data);
        this.$set(this,'pagination', response.data.pagination);
      });
    },
    createnote: function() {
      var input = this.newnote;
      this.$http.post('vueorder_menus',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newnote = {'menu_type':'','menu_plant':'','menu_meal':'','menu_restaurant':'','menu_item':'','menu_money':''};
        $("#create-note").modal('hide');
        toastr.success('新增成功', '訊息', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deletenote: function(order_menu) {
      this.$http.delete('vueorder_menus/'+order_menu.id).then((response) => {
        this.changePage(this.pagination.current_page);
        toastr.success('刪除成功', '訊息', {timeOut: 5000});
      });
    },
    editnote: function(order_menu) {
      this.fillnote.menu_type = order_menu.menu_type;
      this.fillnote.id = order_menu.id;
      this.fillnote.menu_plant = order_menu.menu_plant;
      this.fillnote.menu_meal = order_menu.menu_meal;
      this.fillnote.menu_restaurant = order_menu.menu_restaurant;
      this.fillnote.menu_item = order_menu.menu_item;
      this.fillnote.menu_money = order_menu.menu_money;
      $("#edit-note").modal('show');
    },
    updatenote: function(id) {
      var input = this.fillnote;
      this.$http.put('vueorder_menus/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newnote = {'menu_type':'','menu_plant':'','menu_meal':'','menu_restaurant':'','menu_item':'','menu_money':'','id':''};
        $("#edit-note").modal('hide');
        toastr.success('更新成功', '訊息', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    changePage: function(page) {
      this.pagination.current_page = page;
      this.getVuenote(page);
    }
  }
});