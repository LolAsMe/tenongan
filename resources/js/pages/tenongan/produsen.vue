<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Produsen</h2></div>
        <div class="p-2 bd-highlight">
          <add-produsen-modal></add-produsen-modal>
        </div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar Produsen'">
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
            <tr v-for="produsen in produsens" :key="produsen.id">
              <td class="col-1">{{ produsen.id }}</td>
              <td class="col-3">{{ produsen.kode }}</td>
              <td class="col-4">{{ produsen.nama }}</td>
              <td class="col-4">
                <lihat-produsen-modal class="d-inline"
                  :produsen="produsen"
                ></lihat-produsen-modal>
                <edit-produsen-modal class="d-inline"
                  :produsen="produsen"
                ></edit-produsen-modal>
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  @click="deleteProdusen(produsen.id)"
                >
                  Hapus
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Modal from "~/components/Modal";
import AddProdusenModal from "~/components/tenongan/AddProdusenModal";
import LihatProdusenModal from "~/components/tenongan/LihatProdusenModal";
import EditProdusenModal from "~/components/tenongan/EditProdusenModal";
import BasicModal from "~/components/tenongan/BasicModal";

import Form from "vform";
import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    AddProdusenModal,
    BasicModal,
    LihatProdusenModal,
    EditProdusenModal,
  },
  computed: mapGetters({
    produsens: "produsen/produsens",
  }),
  data() {
    return {};
  },
  methods: {
    async deleteProdusen(id) {
      const { data } = await axios.delete("api/produsen/" + id);
      await this.$store.commit("produsen/deleteProdusen", id);
    },
  },
  created() {
    this.$store.dispatch("produsen/fetchProdusen");
  },
  metaInfo() {
    return { title: "Produsen" };
  },
};
</script>
