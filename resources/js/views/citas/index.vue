<template>
  <div class="app-container">
    <el-table v-loading="loading" :data="appointments" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="#" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Fecha">
        <template slot-scope="scope">
          <span>{{ scope.row.dateapp }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Nota">
        <template slot-scope="scope">
          <span>{{ scope.row.note }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Paciente">
        <template slot-scope="scope">
          <span>{{ scope.row.patient[0].name + ' ' + scope.row.patient[0].lastname }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Doctor">
        <template slot-scope="scope">
          <span>{{ scope.row.doctor[0].name + ' ' + scope.row.doctor[0].lastname }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Estatus">
        <template slot-scope="scope">
          <span :class="isStyle(scope.row.statusapp)">{{ (scope.row.statusapp==1)? 'AGENDADA' : (scope.row.statusapp==2)? 'EN ATENCIÓN' : (scope.row.statusapp==3)? 'ATENDIDA' : (scope.row.statusapp==4)? 'REAGENDADA' : 'CANCELADA' }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="350">
        <template slot-scope="scope">
          <router-link v-if="isEd(scope.row.statusapp)" :to="'/patient/edit/'+scope.row.id">
            <el-button v-permission="['manage user']" type="primary" size="small" icon="el-icon-edit">
              &nbsp;
            </el-button>
          </router-link>
          <el-button v-if="isDel(scope.row.statusapp)" v-permission="['manage user']" type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row.id, scope.row.name, scope.$index);">
            &nbsp;
          </el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>
<script>
// import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
// import { fetchList } from '@/api/article';
// import PatientResource from '@/api/patient';
// const patientResource = new PatientResource();
import axios from 'axios';

export default {
  data() {
    return {
      appointments: [],
      loading: true,
    };
  },
  created() {
    this.loading = true;
    axios.get('/appointment')
      .then((response) => {
        this.appointments = response.data;
      })
      .catch();
    // this.$router.push('/patient');
    this.loading = false;
  },
  methods: {
    isDel(row) {
      if (row === 1 || row === 4) {
        return true;
      }
      return false;
    },
    isEd(row) {
      if (row === 1) {
        return true;
      }
      return false;
    },
    isRea(row) {
      if (row === 1) {
        return true;
      }
      return false;
    },
    isAtc(row) {
      if (row === 1) {
        return true;
      }
      return false;
    },
    isAtd(row) {
      if (row === 2) {
        return true;
      }
      return false;
    },
    isStyle(row) {
      if (row === 1) {
        return 'status B-greend T-white';
      }
      if (row === 2) {
        return 'status B-green T-white';
      }
      if (row === 3) {
        return 'status B-gray T-white';
      }
      if (row === 4) {
        return 'status B-orange T-white';
      }
      if (row === 5) {
        return 'status B-red T-white';
      }
    },
    handleDelete(id, name, index) {
      this.$confirm('Está seguro de borrar la cita # (' + id + '), ¿Continuar?', 'Confirmación', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        axios.get('/appointment/delete/' + id)
          .then(response => {
            this.$message({
              type: 'success',
              message: 'Cita eliminado',
            });
            this.appointments.splice(index, 1);
          }).catch(error => {
            console.log(error);
          });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Eliminado cancelado',
        });
      });
    },
  },
};
</script>
<style lang="scss" scoped>
  .edit-input {
    padding-right: 100px;
  }
  .cancel-btn {
    position: absolute;
    right: 15px;
    top: 10px;
  }
  .dialog-footer {
    text-align: left;
    padding-top: 0;
    margin-left: 150px;
  }
  .app-container {
    flex: 1;
    justify-content: space-between;
    font-size: 14px;
    padding-right: 8px;
    .block {
      float: left;
      min-width: 250px;
    }
    .clear-left {
      clear: left;
    }
    .B-gray
    {
      background-color: gray;
    }
    .B-greend
    {
      background-color: cadetblue;
    }
    .B-green
    {
      background-color: green;
    }
    .B-red
    {
      background-color: red;
    }
    .B-orange
    {
      background-color: orange;
    }
    .T-white
    {
      color: white;
    }
    .T-black
    {
      color: black;
    }
    .status
    {
      padding: 9px;
      border-radius: 18px;
      font-size: 11px;
    }
  }
</style>
