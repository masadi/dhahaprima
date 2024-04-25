<template>
  <b-card>
    <datatable :loading="loading_modal" :isBusy="isBusy" :items="items" :fields="fields" :meta="meta" @per_page="handlePerPage" @pagination="handlePagination" @search="handleSearch" @sort="handleSort" @action="handleAction" />
    <b-modal ref="add-modal" size="xl" :title="title" @ok="handleOk" :ok-title="ok_title" cancel-title="Close">
      <b-form @submit.prevent="handleSubmit">
        <b-row>
          <b-col cols="12">
            <b-form-group label="Page Title" :invalid-feedback="feedback.title" :state="state.title">
              <b-form-input v-model="form.title" :state="state.title" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Page Type" :invalid-feedback="feedback.type" :state="state.type">
              <v-select id="type" v-model="form.type" :reduce="name => name.id" label="name" :options="data_type" placeholder="== Choose Page Type ==" :searchable="false" :state="state.type">
                <template #no-options="{ search, searching, loading }">
                  Tidak ada data untuk ditampilkan
                </template>
              </v-select>
            </b-form-group>
          </b-col>
          <b-col cols="12" v-if="form.type == 'post'">
            <b-form-group label="Page Content" :invalid-feedback="feedback.content" :state="state.content">
              <!--b-form-input v-model="form.content" :state="state.content" /-->
              <vue-editor v-model="form.content" :state="state.content" :editorToolbar="customToolbar"/>
            </b-form-group>
          </b-col>
        </b-row>
      </b-form>
    </b-modal>
    
  </b-card>
</template>

<script>
import { BCard, BButton, BRow, BCol, BForm, BFormGroup, BFormInput, BOverlay, BAlert } from 'bootstrap-vue'
import Datatable from './Datatable.vue' //IMPORT COMPONENT DATATABLENYA
//import socket from '@/services/socketService';
import vSelect from 'vue-select'
import eventBus from '@core/utils/eventBus';
import { VueEditor, Quill } from "vue2-editor";
export default {
  components: {
    BCard,
    BButton,
    BRow, 
    BCol, 
    BForm, BFormGroup, BFormInput, BOverlay, BAlert,
    Datatable,
    vSelect,
    VueEditor
  },
  data() {
    return {
      title: 'Add New Page',
      ok_title: 'Save',
      loading_modal: false,
      isBusy: true,
      fields: [
        {
          key: 'id',
          label: 'ID',
          sortable: true,
          thClass: 'text-center',
          tdClass: 'text-center'
        },
        {
          key: 'title',
          label: 'Title',
          sortable: true,
          thClass: 'text-center',
        },
        {
          key: 'actions',
          label: 'Action',
          sortable: false,
          thClass: 'text-center',
          tdClass: 'text-center'
        },
      ],
      items: [],
      meta: {},
      current_page: 1, //DEFAULT PAGE YANG AKTIF ADA PAGE 1
      per_page: 10, //DEFAULT LOAD PERPAGE ADALAH 10
      search: '',
      sortBy: 'id', //DEFAULT SORTNYA ADALAH CREATED_AT
      sortByDesc: false, //ASCEDING
      form: {
        id: '',
        title: '',
        type: 'post',
        content: '',
      },
      state: {
        title: null,
        type: null,
        content: null,
      },
      feedback: {
        title: '',
        type: '',
        content: '',
      },
      customToolbar: [
        [{ font: [] }],
        [{ header: [false, 1, 2, 3, 4, 5, 6] }],
        //["bold", "italic", "underline", "strike"],
            [{ align: [] }],
            ["blockquote", "code-block"],
            [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
            [{ indent: "-1" }, { indent: "+1" }],
            [{ color: [] }, { background: [] }],
            ["link", "image", "video"],
            ["clean"],
            ["showHtml"]
      ],
      data_type: [
        {
          id: 'post',
          name: 'Post',
        },
        {
          id: 'mitra',
          name: 'Mitra',
        }
      ],
    }
  },
  created() {
    this.loadPostsData()
    eventBus.$on('add-modal', () => {
      this.$refs['add-modal'].show()
    });
  },
  methods: {
    loadPostsData() {
      this.isBusy = true
      //let current_page = this.search == '' ? this.current_page : this.current_page != 1 ? 1 : this.current_page
      let current_page = this.current_page//this.search == '' ? this.current_page : 1
      //LAKUKAN REQUEST KE API UNTUK MENGAMBIL DATA POSTINGAN
      this.$http.get('/dashboard', {
        params: {
          user_id: this.user.id,
          page: current_page,
          per_page: this.per_page,
          q: this.search,
          sortby: this.sortBy,
          sortbydesc: this.sortByDesc ? 'DESC' : 'ASC'
        }
      }).then(response => {
        let getData = response.data.data
        this.isBusy = false
        this.items = getData.data
        this.meta = {
          total: getData.total,
          current_page: getData.current_page,
          per_page: getData.per_page,
          from: getData.from,
          to: getData.to,
        }
      })
    },
    //JIKA ADA EMIT TERKAIT LOAD PERPAGE, MAKA FUNGSI INI AKAN DIJALANKAN
    handlePerPage(val) {
      this.per_page = val //SET PER_PAGE DENGAN VALUE YANG DIKIRIM DARI EMIT
      this.loadPostsData() //DAN REQUEST DATA BARU KE SERVER
    },
    //JIKA ADA EMIT PAGINATION YANG DIKIRIM, MAKA FUNGSI INI AKAN DIEKSEKUSI
    handlePagination(val) {
      this.current_page = val //SET CURRENT PAGE YANG AKTIF
      this.loadPostsData()
    },
    //JIKA ADA DATA PENCARIAN
    handleSearch(val) {
      this.search = val //SET VALUE PENCARIAN KE VARIABLE SEARCH
      this.loadPostsData() //REQUEST DATA BARU
    },
    //JIKA ADA EMIT SORT
    handleSort(val) {
      if (val.sortBy) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.loadPostsData() //DAN LOAD DATA BARU BERDASARKAN SORT
      }
    },
    resetModal(){
      this.form.id = ''
      this.form.title = ''
      this.form.content = ''
    },
    handleDelete(){
      this.$swal({
        title: 'Apakah Anda yakin?',
        text: 'Tindakan ini tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yakin!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
        allowOutsideClick: false,
      }).then(result => {
        if (result.value) {
          this.$http.post('/dashboard/destroy', this.form).then(response => {
            let getData = response.data
            this.$swal({
              icon: getData.icon,
              title: getData.title,
              text: getData.text,
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              this.resetModal()
              this.loadPostsData()
            })
          });
        }
      })
    },
    handleAction(data){
      this.form.id = data.item.id
      this.form.title = data.item.title
      this.form.type = data.item.type
      this.form.content = data.item.content
      if(data.aksi == 'edit'){
        this.title = 'Update Data'
        this.ok_title = 'Update'
        this.$refs['add-modal'].show()
      }
      if(data.aksi == 'delete'){
        this.handleDelete()
      }
    },
    handleOk(bvModalEvent) {
      bvModalEvent.preventDefault()
      this.handleSubmit()
    },
    handleSubmit() {
      this.loading_modal = true
      this.$http.post('/dashboard/store', this.form).then(response => {
        let getData = response.data
        this.loading_modal = false
        if(getData.errors){
          this.state.title = (getData.errors.title) ? false : null
          this.state.content = (getData.errors.content) ? false : null
          this.feedback.title = (getData.errors.title) ? getData.errors.title.join(', ') : ''
          this.feedback.content = (getData.errors.content) ? getData.errors.content.join(', ') : ''
        } else {
          this.$swal({
            icon: getData.icon,
            title: getData.title,
            text: getData.text,
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }).then(result => {
            this.$refs['add-modal'].hide()
            this.loadPostsData()
          })
        }
      })
    },
  },
}
</script>
<style lang="scss">
@import '~@resources/scss/vue/libs/vue-sweetalert.scss';
</style>