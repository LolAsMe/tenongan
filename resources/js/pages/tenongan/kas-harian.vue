<template>
  <div class="row">
    <div class="col-12">
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h2>Kas Harian</h2></div>
        <div class="p-2 bd-highlight"></div>
      </div>
    </div>
    <div class="col-12 mt-2">
      <card :title="'Daftar Kas Harian'">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Tipe</th>
              <th scope="col">Nama</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody v-if="!loading">
            <tr v-for="kasHarian in kasHarians" :key="kasHarian.id">
              <td>{{ kasHarian.tanggal }}</td>
              <td>{{ kasHarian.tipe }}</td>
              <td>{{ kasHarian.payer.nama }}</td>
              <td>{{ kasHarian.jumlah }}</td>
              <td>{{ kasHarian.status }}</td>
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
import Dropdown from "~/components/Dropdown";

import axios from "axios";

// import axios from 'axios'
export default {
  middleware: "auth",
  components: {
    Modal,
    Dropdown,
  },
  computed: mapGetters({
    kasHarians: "kas/harians",
  }),
  data() {
    return {
      loading: true,
    };
  },
  methods: {},
  created() {
    this.$store.dispatch("kas/fetchHarians");
    this.loading = false;
  },
  metaInfo() {
    return { title: "Kas Harian" };
  },
};
</script>
