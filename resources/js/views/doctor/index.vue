<template>
  <div class="app-container">
    <el-table v-loading="loading" :data="doctors" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="#" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Nombres">
        <template slot-scope="scope">
          <span>{{ scope.row.name }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Apellidos">
        <template slot-scope="scope">
          <span>{{ scope.row.lastname }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Tipo de Sangre">
        <template slot-scope="scope">
          <span>{{ scope.row.bloodtype }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Teléfono">
        <template slot-scope="scope">
          <span>{{ scope.row.cellphone }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="350">
        <template slot-scope="scope">
          <router-link v-if="isActive(scope.row.status)" :to="'/patient/edit/'+scope.row.id">
            <el-button v-permission="['manage user']" type="primary" size="small" icon="el-icon-edit">
              &nbsp;
            </el-button>
          </router-link>
          <el-button v-if="isActive(scope.row.status)" v-permission="['manage user']" type="danger" size="small" icon="el-icon-delete" @click="handleDelete(scope.row.id, scope.row.name, scope.$index);">
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
      doctors: [],
      loading: true,
    };
  },
  created() {
    this.loading = true;
    axios.get('/doctor')
      .then((response) => {
        this.doctors = response.data;
      })
      .catch();
    // this.$router.push('/patient');
    this.loading = false;
  },
  methods: {
    isActive(row) {
      return row === 1;
    },
    handleDelete(id, name, index) {
      this.$confirm('Está seguro de borrar al doctor (' + name + '), ¿Continuar?', 'Confirmación', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        axios.get('/doctor/delete/' + id)
          .then(response => {
            this.$message({
              type: 'success',
              message: 'Doctor eliminado',
            });
            this.doctors.splice(index, 1);
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
  }
</style>
