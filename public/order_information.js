Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
  el :'#manage-note',
  data :{
    order_informations: [],
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
    newnote : {'inf_type':'','inf_plant':'','inf_meal':'','inf_time':'','inf_1':'','inf_2':'','inf_3':'','inf_4':'','inf_5':''},
    fillnote : {'inf_type':'','inf_plant':'','inf_meal':'','inf_time':'','inf_1':'','inf_2':'','inf_3':'','inf_4':'','inf_5':'','id':''}
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
      this.$http.get('vueorder_informations?page='+page).then((response) => {

        this.$set(this,'order_informations', response.data.data.data);
        this.$set(this,'pagination', response.data.pagination);
      });
    },
    createnote: function() {
      var input = this.newnote;
      this.$http.post('vueorder_informations',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newnote = {'inf_type':'','inf_plant':'','inf_meal':'','inf_time':'','inf_1':'','inf_2':'','inf_3':'','inf_4':'','inf_5':''};
        $("#create-note").modal('hide');
        toastr.success('新增成功', '訊息', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
      });
    },
    deletenote: function(order_information) {
      this.$http.delete('vueorder_informations/'+order_information.id).then((response) => {
        this.changePage(this.pagination.current_page);
        toastr.success('刪除成功', '訊息', {timeOut: 5000});
      });
    },
    editnote: function(order_information) {
      this.fillnote.inf_type = order_information.inf_type;
      this.fillnote.id = order_information.id;
      this.fillnote.inf_plant = order_information.inf_plant;
      this.fillnote.inf_meal = order_information.inf_meal;
      this.fillnote.inf_time = order_information.inf_time;
      this.fillnote.inf_1 = order_information.inf_1;
      this.fillnote.inf_2 = order_information.inf_2;
      this.fillnote.inf_3 = order_information.inf_3;
      this.fillnote.inf_4 = order_information.inf_4;
      this.fillnote.inf_5 = order_information.inf_5;

      $("#edit-note").modal('show');
    },
    updatenote: function(id) {
      var input = this.fillnote;
      this.$http.put('vueorder_informations/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newnote = {'inf_type':'','inf_plant':'','inf_meal':'','inf_time':'','inf_1':'','inf_2':'','inf_3':'','inf_4':'','inf_5':'','id':''};
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