<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Produsen</h2></div>
        <div class="p-2 bd-highlight">
          <button class="btn btn-primary" v-if="isRole('Admin')" @click="toggleAddModal">Add</button>
          <button class="btn btn-primary" v-if="isRole('Admin')" @click="showModal">Import</button>
          <add-produsen-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-produsen-modal>
          <upload-modal
          :url="'produsen'"
          ref="uploadModal"
          ></upload-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar Produsen'">
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
                    @click="toggleProdusenModal(), setDataLihat(action.data)"
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
                    @click="deleteProdusen(action.data.id)"
                  >
                    Hapus
                  </a>
                </li>
              </dropdown>
            </td>
          </template>
        </v-table>
        <lihat-produsen-modal
          ref="produsenModal"
          :produsen="dataLihat"
          :showModal="showProdusenModal"
          @toggle="toggleProdusenModal"
        ></lihat-produsen-modal>
        <edit-produsen-modal
          ref="editModal"
          :produsen="dataEdit"
          :showModal="showEditModal"
          @toggle="toggleEditModal"
        ></edit-produsen-modal>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddProdusenModal from "~/components/tenongan/AddProdusenModal";
import LihatProdusenModal from "~/components/tenongan/LihatProdusenModal";
import UploadModal from "~/components/tenongan/UploadModal";
import EditProdusenModal from "~/components/tenongan/EditProdusenModal";
import VTable from "~/components/VTable";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddProdusenModal,
    LihatProdusenModal,
    EditProdusenModal,
    UploadModal,
    Dropdown,
    VTable,
  },
  computed: {
    ...mapGetters({
      produsens: "produsen/produsens",
    }),
    items: function () {
      if (!this.loading && this.produsens) {
        return this.produsens.map(({ id, nama }) => {
          return { id, nama };
        });
      }
    },
    itemsTitle: function () {
      return ["ID", "Nama"];
    },
  },
  data() {
    return {
      dataLihat: { id: 0, nama: "null", created_at: "tet", updated_at: "tet" },
      dataEdit: { id: 0, nama: "null", created_at: "tet", updated_at: "tet" },
      showAddModal: false,
      showEditModal: false,
      showProdusenModal: false,
      loading: true,
    };
  },
  methods: {
    async deleteProdusen(id) {
      const { data } = await axios.delete("api/produsen/" + id);
      await this.$store.commit("produsen/deleteProdusen", id);
    },
    setDataLihat(obj) {
      this.dataLihat = obj;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setProdusen(obj);
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal() {
      this.showEditModal = !this.showEditModal;
    },
    toggleProdusenModal() {
      this.showProdusenModal = !this.showProdusenModal;
    },
    showModal(){
      this.$refs.uploadModal.$data.showModal = true
    }
  },
  created() {
    this.$store.dispatch("produsen/fetchProdusen");
    this.loading = false;
  },
  metaInfo() {
    return { title: "Produsen" };
  },
};
</script>
