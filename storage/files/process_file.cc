#include <stdio.h>
#include <unistd.h>
#include <fcntl.h>

int main(int argc, char *argv[])
{
  int res_file = open(argv[1], O_RDWR);  
  int des_file = open(argv[2], O_RDWR|O_TRUNC, 0666);

  char buffer = '\0';

  while ( read(res_file, &buffer, 1) == 1)
  {
    if (buffer != '\0')
    {
      write(des_file, &buffer, 1);
    }
    else
    {
      continue;
    }
  }

  close(res_file);
  close(des_file);
  return 0;
}
