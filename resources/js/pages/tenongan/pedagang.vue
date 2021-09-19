<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Pedagang</h2></div>
        <div class="p-2 bd-highlight">
          <button class="btn btn-primary" @click="toggleAddModal">
            Add
          </button>
          <add-pedagang-modal
            :showModal="showAddModal"
            @toggle="toggleAddModal"
          ></add-pedagang-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar pedagang'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Kode</th>
              <th scope="col">Nama</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="pedagang in pedagangs" :key="pedagang.id">
              <td>{{ pedagang.id }}</td>
              <td>{{ pedagang.kode }}</td>
              <td>{{ pedagang.nama }}</td>
              <td>
                <dropdown name="Action">
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="togglePedagangModal(), setDataLihat(pedagang)"
                    >
                      Lihat
                    </a>
                  </li>
                  <li>
                    <a
                      type="button"
                      class="dropdown-item"
                      @click="toggleEditModal(), setDataEdit(pedagang)"
                    >
                      Edit
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" @click="deletePedagang(pedagang.id)">
                      Hapus
                    </a>
                  </li>
                </dropdown>
              </td>
            </tr>
          </tbody>
        </table>
      </card>
      <lihat-pedagang-modal
        ref="pedagangModal"
        :pedagang="dataLihat"
        :showModal="showPedagangModal"
        @toggle="togglePedagangModal"
      ></lihat-pedagang-modal>
      <edit-pedagang-modal
        ref="editModal"
        :pedagang="dataEdit"
        :showModal="showEditModal"
        @toggle="toggleEditModal"
      ></edit-pedagang-modal>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddPedagangModal from "~/components/tenongan/AddPedagangModal";
import LihatPedagangModal from "~/components/tenongan/LihatPedagangModal";
import EditPedagangModal from "~/components/tenongan/EditPedagangModal";
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddPedagangModal,
    LihatPedagangModal,
    EditPedagangModal,
    Dropdown,
  },
  computed: mapGetters({
    pedagangs: "pedagang/pedagangs",
  }),
  data() {
    return {
      dataAdd: new Object(),
      dataLihat: new Object(),
      dataEdit: new Object(),
      showAddModal: false,
      showEditModal: false,
      showPedagangModal: false,
    };
  },
  methods: {
    async deletePedagang(id) {
      const { data } = await axios.delete("api/pedagang/" + id);
      await this.$store.commit("pedagang/deletePedagang", id);
    },
    setDataAdd(obj) {
      this.dataAdd = obj;
    },
    setDataLihat(obj) {
      this.dataLihat = obj;
    },
    setDataEdit(obj) {
      this.dataEdit = obj;
      this.$refs.editModal.setPedagang(obj)
    },
    toggleAddModal() {
      this.showAddModal = !this.showAddModal;
    },
    toggleEditModal(){
      this.showEditModal = !this.showEditModal
    },
    togglePedagangModal(){
      this.showPedagangModal = !this.showPedagangModal
    },
  },
  created() {
    this.$store.dispatch("pedagang/fetchPedagangs");
  },
  metaInfo() {
    return { title: "Pedagang" };
  },
};
</script>
