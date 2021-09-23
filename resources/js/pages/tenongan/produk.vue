<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Produk</h2></div>
        <div class="p-2 bd-highlight" v-role="'admin'">
          <button class="btn btn-primary" @click="toggleAddModal">Add</button>
          <add-produk-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-produk-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar produk'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nama</th>
              <th scope="col" v-role="'Admin'">Nama Produsen</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Harga Beli</th>
              <th scope="col" v-if="isRole('Admin')">Action</th>
            </tr>
          </thead>
          <tbody v-if="!loading">
            <tr v-for="produk in filterProduk" :key="produk.id">
              <td>{{ produk.nama }}</td>
              <td v-if="isRole('Admin')">{{ produk.produsen.nama }}</td>
              <td>{{ produk.harga_jual }}</td>
              <td>{{ produk.harga_beli }}</td>
              <td>
                <dropdown name="Action" v-if="isRole('Admin')">
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleProdukModal(), setDataLihat(produk)"
                    >
                      Lihat
                    </a>
                  </li>
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleEditModal(), setDataEdit(produk)"
                    >
                      Edit
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" @click="deleteProduk(produk.id)">
                      Hapus
                    </a>
                  </li>
                </dropdown>
              </td>
            </tr>
          </tbody>
        </table>
      </card>
      <lihat-produk-modal
        ref="produkModal"
        :produk="dataLihat"
        :showModal="showProdukModal"
        @toggle="toggleProdukModal"
      ></lihat-produk-modal>
      <edit-produk-modal
        ref="editModal"
        :produk="dataEdit"
        :showModal="showEditModal"
        @toggle="toggleEditModal"
      ></edit-produk-modal>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddProdukModal from "~/components/tenongan/AddProdukModal";
import LihatProdukModal from "~/components/tenongan/LihatProdukModal";
import EditProdukModal from "~/components/tenongan/EditProdukModal";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddProdukModal,
    LihatProdukModal,
    EditProdukModal,
    Dropdown,
  },
  computed: {
    ...mapGetters({
      produks: "produk/produks",
    }),
    filterProduk: function () {
      if(this.isRole('Admin')){
        return this.produks.filter(produk => produk.produsen)
      }else{
        return this.produks

      }
    }

  },
  data() {
    return {
      dataAdd: new Object(),
      dataLihat: new Object(),
      dataEdit: new Object(),
      showAddModal: false,
      showEditModal: false,
      showProdukModal: false,
      loading: true,
      role: null,
    };
  },
  methods: {
    async deleteProduk(id) {
      const { data } = await axios.delete("api/produk/" + id);
      await this.$store.commit("produk/deleteProduk", id);
    },
    setDataAdd(obj) {
      this.dataAdd = obj;
    },
    setDataLihat(obj) {
      this.dataLihat = obj;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setProduk(obj);
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal() {
      this.showEditModal = !this.showEditModal;
    },
    toggleProdukModal() {
      this.showProdukModal = !this.showProdukModal;
    },
  },
  created() {
    this.$store.dispatch("produk/fetchProduks");
    this.role = this.$store.getters["auth/user"].tipe;
    this.loading = false;
  },
  metaInfo() {
    return { title: "Produk" };
  },
};
</script>
