import Layout from '@/layout';

const agendamientoRoutes = {
  path: '/agendamiento',
  component: Layout,
  redirect: '/agendamiento/index',
  name: 'Agendamientos',
  meta: {
    title: 'Agendamiento',
    icon: 'layout',
    permissions: ['view menu component ui'],
  },
  children: [
    {
      path: 'citas',
      name: 'Citas',
      component: () => import('@/views/citas/index'),
      meta: { title: 'Citas', icon: 'list' },
    },
    {
      path: 'agenda',
      name: 'Agenda',
      component: () => import('@/views/doctor/index'),
      meta: { title: 'Agenda', icon: 'list' },
    },
  ],
};

export default agendamientoRoutes;
