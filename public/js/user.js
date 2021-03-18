Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
new Vue({
  el :'#manage-note',
  data :{
    users: [],
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
    newnote : {'jobid':'','name':'','email':'','password':'','authority':''},
    fillnote : {'jobid':'','name':'','email':'','password':'','authority':'','id':''}
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
      this.$http.get('vueusers?page='+page).then((response) => {

        this.$set(this,'users', response.data.data.data);
        this.$set(this,'pagination', response.data.pagination);
      });
    },
    createnote: function() {
      var input = this.newnote;
      this.$http.post('vueusers',input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newnote = {'jobid':'','name':'','email':'','password':'','authority':''};
        $("#create-note").modal('hide');
        toastr.success('新增成功', '訊息', {timeOut: 5000});
      }, (response) => {
        this.formErrors = response.data;
        toastr.error(response.data.errors.jobid, '錯誤', {timeOut: 5000});
      });
    },
    deletenote: function(user) {
      this.$http.delete('vueusers/'+user.id).then((response) => {
        this.changePage(this.pagination.current_page);
        toastr.success('刪除成功', '訊息', {timeOut: 5000});
      });
    },
    editnote: function(user) {
      this.fillnote.jobid = user.jobid;
      this.fillnote.id = user.id;
      this.fillnote.name = user.name;
      this.fillnote.email = user.email;
      this.fillnote.password = user.password;
      this.fillnote.authority = user.authority;
      $("#edit-note").modal('show');
    },
    updatenote: function(id) {
      var input = this.fillnote;
      this.$http.put('vueusers/'+id,input).then((response) => {
        this.changePage(this.pagination.current_page);
        this.newnote = {'jobid':'','name':'','email':'','password':'','authority':'','id':''};
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