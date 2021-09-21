import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = {
  kass: [
  ],
  kas: [
  ],
  harians: [{ "id": 1, payer:{nama:'default'}}]
}

// getters
export const getters = {
  kass: state => state.kass,
  kas: state => state.kas,
  harians: state => state.harians,
}

// mutations
export const mutations = {
  setKass: (state, kass) => (state.kass = kass),
  setHarians: (state, harians) => (state.harians = harians),
  setKas: (state, kas) => (state.kas = kas),
  addLog: (state, kas) => state.kas.log.push(kas),
  editKas(state, nKas) {
    const oldKas = state.kass.find(kas => kas.id === nKas.id);
    if (oldKas) {
      // not creating a new object but modifying old object here
      Object.assign(oldKas, nKas)
    }
  },
  deleteKas: (state, id) => state.kass = state.kass.filter(kas => kas.id !== id)
}

// actions
export const actions = {
  async fetchKas({ commit }) {
    const { data } = await axios.get('/api/kas')
    commit('setKas', data)
  },
  async fetchHarians({ commit }) {
    const { data } = await axios.get('/api/kas/harian')
    commit('setHarians', data)
  }
}
