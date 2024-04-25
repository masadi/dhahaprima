<template>
  <b-card>
    <datatable :loading="loading_modal" :isBusy="isBusy" :items="items" :fields="fields" :meta="meta" @per_page="handlePerPage" @pagination="handlePagination" @search="handleSearch" @sort="handleSort" @action="handleAction" @status="handleStatus" />
    <b-modal ref="add-modal" size="xl" :title="title" @ok="handleOk" :ok-title="ok_title" cancel-title="Close">
      <b-form @submit.prevent="handleSubmit">
        <b-row>
          <b-col cols="12">
            <b-form-group label="Nomor Registrasi" :invalid-feedback="feedback.nomor_registrasi" :state="state.nomor_registrasi">
              <b-form-input v-model="form.nomor_registrasi" :state="state.nomor_registrasi" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="NIB" :invalid-feedback="feedback.nib" :state="state.nib">
              <b-form-input v-model="form.nib" :state="state.nib" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="NPWP" :invalid-feedback="feedback.npwp" :state="state.npwp">
              <b-form-input v-model="form.npwp" :state="state.npwp" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Nama Perusahaan" :invalid-feedback="feedback.nama_perusahaan" :state="state.nama_perusahaan">
              <b-form-input v-model="form.nama_perusahaan" :state="state.nama_perusahaan" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Brand">
              <b-form-input v-model="form.brand" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Alamat">
              <b-form-input v-model="form.alamat" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Provinsi">
              <b-overlay :show="loading_provinsi" opacity="0.6" size="md" spinner-variant="secondary">
                <v-select id="provinsi_id" v-model="form.provinsi_id" :reduce="name => name.code" label="name" @input="getKabupaten" :options="data_provinsi" placeholder="== Pilih Provinsi ==">
                  <template #no-options="{ search, searching, loading }">
                    Tidak ada data untuk ditampilkan
                  </template>
                </v-select>
              </b-overlay>
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Kabupaten/Kota">
              <b-overlay :show="loading_kabupaten" opacity="0.6" size="md" spinner-variant="secondary">
                <v-select id="kabupaten_id" v-model="form.kabupaten_id" :reduce="name => name.code" label="name" @input="getKecamatan" :options="data_kabupaten" placeholder="== Pilih Kabupaten/Kota ==">
                  <template #no-options="{ search, searching, loading }">
                    Tidak ada data untuk ditampilkan
                  </template>
                </v-select>
              </b-overlay>
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Kecamatan">
              <b-overlay :show="loading_kecamatan" opacity="0.6" size="md" spinner-variant="secondary">
                <v-select id="kecamatan_id" v-model="form.kecamatan_id" :reduce="name => name.code" label="name" @input="getDesa" :options="data_kecamatan" placeholder="== Pilih Kecamatan ==">
                  <template #no-options="{ search, searching, loading }">
                    Tidak ada data untuk ditampilkan
                  </template>
                </v-select>
              </b-overlay>
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Desa/Kelurahan">
              <b-overlay :show="loading_desa" opacity="0.6" size="md" spinner-variant="secondary">
                <v-select id="desa_id" v-model="form.desa_id" :reduce="name => name.code" label="name" :options="data_desa" placeholder="== Pilih Desa/Kelurahan ==">
                  <template #no-options="{ search, searching, loading }">
                    Tidak ada data untuk ditampilkan
                  </template>
                </v-select>
              </b-overlay>
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Nomor Telpon/WA">
              <b-form-input v-model="form.telepon" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Email">
              <b-form-input v-model="form.email" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Website">
              <b-form-input v-model="form.website" />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-form-group label="Logo" :invalid-feedback="feedback.file" :state="state.file">
              <b-form-file v-model="form.file" placeholder="Choose a file or drop it here..." drop-placeholder="Drop file here..." @change="onFileChange" :state="state.file" />
            </b-form-group>
          </b-col>
        </b-row>
      </b-form>
    </b-modal>
    
  </b-card>
</template>

<script>
import { BCard, BButton, BRow, BCol, BForm, BFormGroup, BFormInput, BFormFile, BOverlay, BAlert } from 'bootstrap-vue'
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
    BForm, BFormGroup, BFormInput, BFormFile, BOverlay, BAlert,
    Datatable,
    vSelect,
    VueEditor
  },
  data() {
    return {
      title: 'Add New Mitra',
      ok_title: 'Save',
      loading_modal: false,
      loading_provinsi: false,
      loading_kabupaten: false,
      loading_kecamatan: false,
      loading_desa: false,
      isBusy: true,
      fields: [
        {
          key: 'nama_perusahaan',
          label: 'Nama Perusahaan',
          sortable: true,
          thClass: 'text-center',
        },
        {
          key: 'alamat',
          label: 'Alamat',
          sortable: true,
          thClass: 'text-center',
        },
        {
          key: 'telepon',
          label: 'No. Telepon/WA',
          sortable: true,
          thClass: 'text-center',
        },
        {
          key: 'email',
          label: 'Email',
          sortable: true,
          thClass: 'text-center',
        },
        {
          key: 'status',
          label: 'Status',
          sortable: true,
          thClass: 'text-center',
          tdClass: 'text-center'
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
        nomor_registrasi: '',
        nib: '',
        npwp: '',
        nama_perusahaan: '',
        brand: '',
        alamat: '',
        provinsi_id: '',
        kabupaten_id: '',
        kecamatan_id: '',
        desa_id: '',
        telepon: '',
        email: '',
        website: '',
        file: null,
      },
      state: {
        nomor_registrasi: null,
        nib: null,
        npwp: null,
        nama_perusahaan: null,
        file: null,
      },
      feedback: {
        nomor_registrasi: '',
        nib: '',
        npwp: '',
        nama_perusahaan: '',
        file: '',
      },
      data_provinsi: [],
      data_kabupaten: [],
      data_kecamatan: [],
      data_desa: [],
    }
  },
  created() {
    this.loadPostsData()
    eventBus.$on('add-mitra', () => {
      this.$refs['add-modal'].show()
      this.getProvinsi()
    });
  },
  methods: {
    loadPostsData() {
      this.isBusy = true
      //let current_page = this.search == '' ? this.current_page : this.current_page != 1 ? 1 : this.current_page
      let current_page = this.current_page//this.search == '' ? this.current_page : 1
      //LAKUKAN REQUEST KE API UNTUK MENGAMBIL DATA POSTINGAN
      this.$http.get('/mitra', {
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
      this.form.nomor_registrasi = ''
      this.form.nib = ''
      this.form.npwp = ''
      this.form.nama_perusahaan = ''
      this.form.brand = ''
      this.form.alamat = ''
      this.form.provinsi_id = ''
      this.form.kabupaten_id = ''
      this.form.kecamatan_id = ''
      this.form.desa_id = ''
      this.form.telepon = ''
      this.form.email = ''
      this.form.website = ''
      this.form.file = null
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
          this.$http.post('/mitra/destroy', this.form).then(response => {
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
      this.resetModal()
      this.form.id = data.item.id
      this.form.nomor_registrasi = data.item.nomor_registrasi
      this.form.nib = data.item.nib
      this.form.npwp = data.item.npwp
      this.form.nama_perusahaan = data.item.nama_perusahaan
      this.form.brand = data.item.brand
      this.form.alamat = data.item.alamat
      this.form.provinsi_id = data.item.provinsi_id
      this.form.kabupaten_id = data.item.kabupaten_id
      this.form.kecamatan_id = data.item.kecamatan_id
      this.form.desa_id = data.item.desa_id
      this.form.telepon = data.item.telepon
      this.form.email = data.item.email
      this.form.website = data.item.website
      this.form.file = null
      if(data.aksi == 'edit'){
        this.getProvinsi()
        this.getKabupaten()
        this.getKecamatan()
        this.getDesa()
        this.title = 'Update Data'
        this.ok_title = 'Update'
        this.$refs['add-modal'].show()
      }
      if(data.aksi == 'delete'){
        this.handleDelete()
      }
    },
    handleStatus(data){
      console.log(data);
      this.$swal({
        title: 'Apakah Anda yakin?',
        text: 'Tindakan ini tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: data.aksi.charAt(0).toUpperCase() + data.aksi.slice(1),
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
        allowOutsideClick: false,
      }).then(result => {
        if (result.value) {
          this.$http.post(`/mitra/${data.aksi}`, {
            mitra_id: data.item.id
          }).then(response => {
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
    handleOk(bvModalEvent) {
      bvModalEvent.preventDefault()
      this.handleSubmit()
    },
    onFileChange(e) {
      this.file = e.target.files[0];
    },
    handleSubmit() {
      this.loading_modal = true
      this.state.nomor_registrasi = null
      this.state.nib = null
      this.state.npwp = null
      this.state.nama_perusahaan = null
      this.state.file = null
      this.feedback.nomor_registrasi = ''
      this.feedback.nib = ''
      this.feedback.npwp = ''
      this.feedback.nama_perusahaan = ''
      this.feedback.file = ''
      const data = new FormData();
      data.append('id', this.form.id);
      data.append('nomor_registrasi', this.form.nomor_registrasi);
      data.append('nib', this.form.nib);
      data.append('npwp', this.form.npwp);
      data.append('nama_perusahaan', this.form.nama_perusahaan);
      data.append('brand', this.form.brand);
      data.append('alamat', this.form.alamat);
      data.append('provinsi_id', this.form.provinsi_id);
      data.append('kabupaten_id', this.form.kabupaten_id);
      data.append('kecamatan_id', this.form.kecamatan_id);
      data.append('desa_id', this.form.desa_id);
      data.append('telepon', this.form.telepon);
      data.append('email', this.form.email);
      data.append('website', this.form.website);
      data.append('photo', (this.form.file) ? this.form.file : '');
      this.$http.post('/mitra/store', data).then(response => {
        let getData = response.data
        this.loading_modal = false
        if(getData.errors){
          this.state.nomor_registrasi = (getData.errors.nomor_registrasi) ? false : null
          this.state.nib = (getData.errors.nib) ? false : null
          this.state.npwp = (getData.errors.npwp) ? false : null
          this.state.nama_perusahaan = (getData.errors.nama_perusahaan) ? false : null
          this.state.file = (getData.errors.photo) ? false : null
          this.feedback.nomor_registrasi = (getData.errors.nomor_registrasi) ? getData.errors.nomor_registrasi.join(', ') : ''
          this.feedback.nib = (getData.errors.nib) ? getData.errors.nib.join(', ') : ''
          this.feedback.npwp = (getData.errors.npwp) ? getData.errors.npwp.join(', ') : ''
          this.feedback.nama_perusahaan = (getData.errors.nama_perusahaan) ? getData.errors.nama_perusahaan.join(', ') : ''
          this.feedback.file = (getData.errors.photo) ? getData.errors.photo.join(', ') : ''
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
    getProvinsi(){
      this.loading_provinsi = true
      this.$http.post('/mitra/provinsi').then(response => {
        this.loading_provinsi = false
        this.data_provinsi = response.data
      });
    },
    getKabupaten(val){
      this.loading_kabupaten = true
      this.$http.post('/mitra/kabupaten', this.form).then(response => {
        this.loading_kabupaten = false
        this.data_kabupaten = response.data
      });
    },
    getKecamatan(val){
      this.loading_kecamatan = true
      this.$http.post('/mitra/kecamatan', this.form).then(response => {
        this.loading_kecamatan = false
        this.data_kecamatan = response.data
      });
    },
    getDesa(val){
      this.loading_desa = true
      this.$http.post('/mitra/desa', this.form).then(response => {
        this.loading_desa = false
        this.data_desa = response.data
      });
    },
  },
}
</script>
<style lang="scss">
@import '~@resources/scss/vue/libs/vue-sweetalert.scss';
</style>