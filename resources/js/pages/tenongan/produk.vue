<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Produk</h2></div>
        <div class="p-2 bd-highlight" v-role="'Admin'">
          <button class="btn btn-primary" @click="toggleAddModal">Add</button>
          <add-produk-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-produk-modal>
          <button
            class="btn btn-primary"
            @click="$refs.uploadModal.$data.showModal = true"
            v-if="isRole('Admin')"
          >
            Import
          </button>

          <upload-modal v-if="isRole('Admin')" ref="uploadModal" :url="'produk'"></upload-modal>>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar Produk'">
        <v-table
          :items="items"
          :itemsTitle="itemsTitle"
          :isAction="isRole('Admin')"
        >
          <template v-slot:action="action">
            <td>
              <dropdown name="Action">
                <li>
                  <a
                    type="button"
                    class="dropdown-item"
                    @click="toggleProdukModal(), setDataLihat(action.data)"
                  >
                    Lihat
                  </a>
                </li>
                <li>
                  <a
                    type="button"
                    class="dropdown-item"
                    @click="toggleEditModal(), setDataEdit(action.data)"
                  >
                    Edit
                  </a>
                </li>
                <li>
                  <a
                    type="button"
                    class="dropdown-item"
                    @click="deleteProduk(action.data.id)"
                  >
                    Hapus
                  </a>
                </li>
              </dropdown>
            </td>
          </template>
        </v-table>
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
import UploadModal from "~/components/tenongan/UploadModal";
import VTable from "~/components/VTable";
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
    VTable,
    UploadModal,
    Dropdown,
  },
  computed: {
    ...mapGetters({
      produks: "produk/produks",
    }),
    items: function () {
      if (!this.loading && this.produks) {
        return this.produks.map(({ id, nama, harga_jual, harga_beli }) => {
          return { id, nama, harga_jual, harga_beli };
        });
      }
    },
    itemsTitle: function () {
      return ["ID", "Nama", "harga_jual", "harga_jual"];
    },
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
