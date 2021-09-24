import axios from 'axios'
import store from '~/store'


// state
export const state = {
  penjualans: [
  ],
  dataPenjualans: [
  ]

}

// getters
export const getters = {
  penjualans: state => state.penjualans,
  dataPenjualans: state => state.dataPenjualans,
  check: state => state.id !== null
}

// mutations
export const mutations = {
  setPenjualans: (state, penjualans) => (state.penjualans = penjualans),
  addDataPenjualan: (state, penjualan) => state.dataPenjualans.push(penjualan),
  resetDataPenjualan: (state) => state.dataPenjualans=[],
  addPenjualan: (state, penjualan) => state.penjualans.push(penjualan),
  editPenjualan(state, nPenjualan){
    const oldPenjualan = state.penjualans.find( penjualan => penjualan.id === nPenjualan.id );
    if (oldPenjualan) {
      // not creating a new object but modifying old object here
      Object.assign(oldPenjualan, nPenjualan)
    }
  },
  deletePenjualan: (state, id) => state.penjualans = state.penjualans.filter(penjualan => penjualan.id !== id)
}

// actions
export const actions = {
  async fetchPenjualan({ commit }){
    let id = store.getters['auth/user'].owner_id
    let role = store.getters['auth/user'].tipe
    let data = []
    if(role == 'Admin'){
      data =  (await axios.get('/api/penjualan')).data
    }
    if(role == 'Produsen'){
      data =  (await axios.get('/api/produsen/penjualan/'+id)).data
    }
    if(role == 'Pedagang'){
      data =  (await axios.get('/api/pedagang/penjualan/'+id)).data
    }
    commit('setPenjualans',data)
  },
  async titip({ commit, state }){
    const { data } = await axios.post('/api/transaksi/penjualan/titip', state.dataPenjualans)
  }
}
