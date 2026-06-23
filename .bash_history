sudo apt update
sudo apt install ansible -y
sudo dnf install epel-release -y
sudo dnf install ansible -y
sudo dnf install epel-release -y
ping -c 4 google.com
sudo apt update && sudo apt install ansible -y
sudo dnf install epel-release -y
sudo dnf install ansible -ysudo dnf install epel-release -y
sudo dnf install ansible -y
pip install ansible
install ansible
app install ansible
sudo apt install ansible -y
ping -c 4 google.com
sudo apt update && sudo apt install ansible -y
ansible-playbook -i inventory pb_template_dasar.yml
[defaults]
inventory = inventory
nano inventory
[myserver]
localhost ansible_connection=local
ansible-playbook -i inventory pb_template_dasar.yml
nano inventory
ansible-playbook -i inventory pb_template_dasar.yml
templates/motd.j2
nano templates/motd.j2
pb_template_dasar.yml
nano pb_template_dasar.yml
nano templates/environment_banner.j2
nano pb_template_conditional.yml
nano templates/hosts.j2
pb_template_loop.yml
nano pb_template_loop.yml
templates/nginx_vhost.j2
nano templates/nginx_vhost.j2
nano pb_nginx_template.yml
---
# tasks file for roles/webserver_dasar
- name: Install paket dasar text editor utilities
mkdir -p templates roles/webserver_dasar/tasks roles/app_stack/vars roles/app_stack/templates roles/app_stack/tasks
nano inventory
nano templates/motd.j2
nano pb_nginx_template.yml
nano roles/webserver_dasar/tasks/main.yml
nano site_role_dasar.yml
nano roles/app_stack/vars/main.yml
nano roles/app_stack/templates/app_config.cfg.j2
nano roles/app_stack/tasks/main.yml
nano site_role_kompleks.yml
nano pb_handler_dasar.yml
nano pb_handler_kompleks.yml
ansible-playbook -i inventory pb_template_dasar.yml
ansible-playbook -i inventory pb_template_conditional.yml
ansible-playbook -i inventory pb_template_loop.yml
ansible-playbook -i inventory pb_nginx_template.yml
ansible-playbook -i inventory site_role_dasar.yml
ansible-playbook -i inventory site_role_kompleks.yml
ansible-playbook -i inventory pb_handler_dasar.yml
ansible-playbook -i inventory pb_handler_kompleks.yml
sudo kill -9 2773
sudo rm /var/lib/dpkg/lock-frontend
sudo rm /var/lib/dpkg/lock
sudo dpkg --configure -a
ansible-playbook -i inventory pb_handler_kompleks.yml
ansible-playbook -i inventory pb_template_dasar.yml
ansible-playbook -i inventory pb_template_conditional.yml
ansible-playbook -i inventory pb_template_loop.yml
ansible-playbook -i inventory pb_nginx_template.yml
ansible-playbook -i inventory site_role_dasar.yml
ansible-playbook -i inventory site_role_kompleks.yml
ansible-playbook -i inventory pb_handler_dasar.yml
ansible-playbook -i inventory pb_handler_kompleks.yml
nano templates/motd.j2 
nano pb_template_dasar.yml
nano pb_template_dasar.yml 
ansible-playbook -i inventory pb_template_dasar.yml 
cat /etc/motd
nano templates/environment_banner.j2
nano pb_template_conditional.yml
ansible-playbook -i inventory pb_template_conditional.yml
cat /etc/environment_banner
nano templates/hosts.j2
nano pb_template_loop.yml
ansible-playbook -i inventory pb_template_loop.yml 
cat /tmp/hosts_custom
nano templates/nginx_vhost.j2
nano templates/nginx_vhost.j2 
nano pb_nginx_template.yml 
ansible-playbook -i inventory pb_nginx_template.yml
curl -I http://localhost:8080
ss -tulpen | grep -E "8080|8081"
curl -I http://localhost:8081
HTTP/1.1 200 OK
Server: Apache/2.4.x (Ubuntu)
...
ansible-galaxy init roles/webserver_dasar 
nano roles/webserver_dasar/tasks/main.yml
nano site_role_dasar.yml
ansible-playbook -i inventory site_role_dasar.yml
ansible-galaxy init roles/webserver_dasar 
nano roles/webserver_dasar/tasks/main.yml
ansible-galaxy init roles/webserver_dasar 
nano site_role_dasar.yml
ansible-playbook -i inventory site_role_dasar.yml
ansible-galaxy init roles/webserver_dasar 
nano roles/webserver_dasar/tasks/main.yml
nano site_role_dasar.yml
ansible-playbook -i inventory site_role_dasar.yml
nano roles/webserver_dasar/tasks/main.yml
ansible-playbook -i inventory site_role_dasar.yml
htop
ansible-galaxy init roles/webserver_dasar 
mkdir -p roles/app_stack/vars roles/app_stack/templates roles/app_stack/tasks
---
app_port: 9000
app_user: 'developer'
nano roles/app_stack/vars/main.yml
nano roles/app_stack/templates/app_config.cfg.j2
# Konfigurasi Aplikasi Internal
LISTEN_PORT={{ app_port }}
ALLOWED_USER={{ app_user }}
nano roles/app_stack/tasks/main.yml
---
- name: Buat user system untuk aplikasi
- name: Generate konfigurasi aplikasi dari internal template
---
- name: Buat user system untuk aplikasi
- name: Generate konfigurasi aplikasi dari internal template
nano site_role_kompleks.yml
ansible-playbook -i inventory site_role_kompleks.yml
mkdir -p roles/webserver_dasar/tasks
nano roles/webserver_dasar/tasks/main.yml
nano site_role_dasar.yml 
ansible-playbook -i inventory site_role_dasar.yml
mkdir -p roles/app_stack/tasks roles/app_stack/vars roles/app_stack/templates
cd root
sudo -i
ansible-playbook -i inventory pb_handler_dasar.yml
ansible-playbook -i inventory pb_handler_dasar.yml -K
ansible-playbook -i inventory pb_handler_dasar.yml
ansible-playbook -i inventory pb_handler_kompleks.yml
ss -tulpen | grep 8081
nano pb_template_conditional.yml
ansible-playbook -i inventory pb_template_loop.yml
fadlan@fadlan:~$ ansible-playbook -i inventory pb_template_loop.yml
PLAY [all] **************************************************************************************************************************
TASK [Gathering Facts] **************************************************************************************************************
fatal: [localhost]: FAILED! => {"ansible_facts": {}, "changed": false, "failed_modules": {"ansible.legacy.setup": {"ansible_facts": {"discovered_interpreter_python": "/usr/bin/python3.13"}, "failed": true, "module_stderr": "sudo: a password is required\n", "module_stdout": "", "msg": "MODULE FAILURE: No start of json char found\nSee stdout/stderr for the exact e
ansible-playbook -i inventory pb_template_loop.yml -K
ansible-galaxy init roles/webserver_dasar
ls -R roles/webserver_dasar
ansible-galaxy init roles/webserver_dasar --force
ansible-galaxy init roles/webserver_kedua
mkdir -p roles/webserver_dasar/tasks
nano roles/webserver_dasar/tasks/main.yml
docker info
systemctl start docker
docker info
exit
sudo usermod -aG docker fadlan
newgrp docker
exit
nano Dockerfile
docker compose -v
docker compose down -v
docker images
docker rmi fadlanxisija2
docker build -t fadlanxisija2.
docker build -t fadlanxisija2 .
docker compose up -d
docker compose ps
nano docker-compose
nano docker-compose.yaml
nano docker-compose.yaml
docker compose ps
docker compose up -d
docker compose down -v
docker compose -v
docker build -t fadlanxisija2.
docker build -t fadlanxisija2 .
docker compose down -v
docker compose up -d
docker ps
docker-compose up -d
docker compose up -d
nano docker-compose.yaml
sudo apt update
exit
docker compose ps
docker compose up -d
docker compose down -v
docker compose up -d
docker compose -v
docker build -t fadlanxisija2 .
docker swarm init --advertise-addr 192.168.101.17
docker swarm init --advertise-addr 192.168.50.11
sudo nano /etc/netplan/50-cloud-init.yaml 
docker swarm leave --force
docker swarm init --advertise-addr 192.168.101.17
docker node ls
docker network create --driver overlay net-xisijaB
docker volume create vol-xisijaB
nano Dockerfile
docker login
docker-compose.yml
nano docker-compose.yml
nano Dockerfile
nano docker-compose.yaml
pwd
ls -la
nano nginx.conf
ls -la
hostnamectl
sudo hostnamectl set-hostname managed
sudo nano /etc/hosts
sudo systemctl restart systemd-hostnamed
exit
git clone https://github.com/llrdhann/web-asat-10sija-2.git
docker info
systemctl start docker
docker info
exit
git clone https://github.com/llrdhann/web-asat-10-sija-2.git
ls
nano Dockerfile
docker build -t fadlanxisija2
sudo hostnamectl set-hostname managed
exit
sudo hostnamectl set-hostname remedial-sysadmin
exit\
exit
