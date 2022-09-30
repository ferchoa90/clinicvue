import Layout from '@/layout';

const elementUiRoutes = {
  path: '/element-ui',
  component: Layout,
  redirect: '/element-ui/form',
  name: 'Mantenimiento',
  meta: {
    title: 'elementUi',
    icon: 'layout',
    permissions: ['view menu element ui'],
  },
  children: [
    {
      path: 'patient',
      name: 'Pacientes',
      component: () => import('@/views/patient/index'),
      meta: { title: 'Pacientes', icon: 'user' },
    },
    {
      path: 'doctor',
      name: 'Doctores',
      component: () => import('@/views/doctor/index'),
      meta: { title: 'Doctores', icon: 'user' },
    },
    {
      path: 'tab',
      component: () => import('@/views/tab'),
      name: 'Tab',
      meta: { title: 'tab', icon: 'tab' },
    },
  ],
};

export default elementUiRoutes;
