<template>
  <basic-modal v-if="showModal" @close="$emit('toggle')">
    <h5 slot="header">Log Saldo</h5>
    <div slot="body">
      <!-- {{ saldo }} -->
      <div v-if="!loading">
        Jumlah Saldo = {{ saldo.jumlah }} Nama Pedagang = {{ saldo.owner.nama }}
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="log in saldo.log" :key="log.id">
            <td>{{ log.id }}</td>
            <td>{{ log.keterangan }}</td>
            <td>{{ log.jumlah }}</td>
            <td>{{ log.tanggal }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <template v-slot:footer>
      <button @click="$emit('toggle')" class="btn btn-secondary btn-sm">
        Close
      </button>
    </template>
  </basic-modal>
</template>

<script>
import Modal from "~/components/Modal";
import BasicModal from "~/components/tenongan/BasicModal";
import Form from "vform";

export default {
  name: "LogSaldoModal",
  props: {
    saldo: {
      type: Object,
      default: function(){
        return { saldo: 0, payer: { nama: "test" } }
      }
    },
    showModal: { type: Boolean, default: true },
  },
  components: {
    Modal,
    BasicModal,
  },
  data() {
    return {
      loading: true,
    };
  },
  methods: {},
};
</script>
