import prisma from '@/config/prisma';

class UserModel {
  checkUserAuthentication = async (id) => {
    const user = await prisma.user.findFirst({
      where: {
        id: id,
      },
      include: {
        sessions: true,
      },
    });

    return user && user.sessions.length > 0;
  };
}

export default UserModel;
