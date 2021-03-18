Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
  el :'#manage-note',
  data :{
    restaurants: [],
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
    newnote : {'restaurant_type':'','restaurant_plant':'','restaurant_meal':'','restaurant_time':'','restaurant_name':'','restaurant_1':'','restaurant_2':'','restaurant_logo':'','restaurant_menu':'','restaurant_phone':'','restaurant_address':''},
    fillnote : {'restaurant_type':'','restaurant_plant':'','restaurant_meal':'','restaurant_time':'','restaurant_name':'','restaurant_1':'','restaurant_2':'','restaurant_logo':'','restaurant_menu':'','restaurant_phone':'','restaurant_address':'','id':''}
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
      this.$http.get('vuerestaurants?page='+page).then((response) => {

        this.$set(this,'restaurants', response.data.data.data);
        this.$set(this,'pagination', response.data.pagination);
      });
    },
    createnote: function() {
      var input = this.newnote;
      this.$http.post('vuerestaurants',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newnote = {'restaurant_type':'','restaurant_plant':'','restaurant_meal':'','restaurant_time':'','restaurant_name':'','restaurant_1':'','restaurant_2':'','restaurant_logo':'','restaurant_menu':'','restaurant_phone':'','restaurant_address':''};
        $("#create-note").modal('hide');
        toastr.success('新增成功', '訊息', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deletenote: function(restaurant) {
      this.$http.delete('vuerestaurants/'+restaurant.id).then((response) => {
        this.changePage(this.pagination.current_page);
        toastr.success('刪除成功', '訊息', {timeOut: 5000});
      });
    },
    editnote: function(restaurant) {
      this.fillnote.restaurant_type = restaurant.restaurant_type;
      this.fillnote.id = restaurant.id;
      this.fillnote.restaurant_plant = restaurant.restaurant_plant;
      this.fillnote.restaurant_meal = restaurant.restaurant_meal;
      this.fillnote.restaurant_name = restaurant.restaurant_name;
      this.fillnote.restaurant_logo = restaurant.restaurant_logo;
      this.fillnote.restaurant_menu = restaurant.restaurant_menu;
      $("#edit-note").modal('show');
    },
    updatenote: function(id) {
      var input = this.fillnote;
      this.$http.put('vuerestaurants/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newnote = {'restaurant_type':'','restaurant_plant':'','restaurant_meal':'','restaurant_time':'','restaurant_name':'','restaurant_1':'','restaurant_2':'','restaurant_logo':'','restaurant_menu':'','restaurant_phone':'','restaurant_address':'','id':''};
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