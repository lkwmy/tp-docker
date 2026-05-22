FROM python:3.11-slim

RUN apt update -y && apt install -y \
    gcc \
    build-essential \
    python3-dev \
    libsasl2-dev \
    libldap2-dev \
    libssl-dev \
    && apt clean

COPY student_age.py /

COPY requirements.txt /

RUN pip3 install --upgrade pip setuptools wheel
RUN pip3 install -r /requirements.txt

RUN mkdir /data
VOLUME /data

EXPOSE 5000

CMD ["python3", "./student_age.py"]