﻿// <auto-generated />
using System;
using LIMS.Models;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Migrations;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;

namespace LIMS.Migrations
{
    [DbContext(typeof(LimsContext))]
    [Migration("20200226015421_TodosModelosCriados")]
    partial class TodosModelosCriados
    {
        protected override void BuildTargetModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder
                .HasAnnotation("ProductVersion", "3.1.0")
                .HasAnnotation("Relational:MaxIdentifierLength", 64);

            modelBuilder.Entity("LIMS.Models.Amostra", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<DateTime>("Create_at")
                        .HasColumnType("datetime(6)");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("Observacao")
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<string>("UsuarioId")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<int?>("UsuarioId1")
                        .HasColumnType("int");

                    b.HasKey("Id");

                    b.HasIndex("UsuarioId1");

                    b.ToTable("Amostra");
                });

            modelBuilder.Entity("LIMS.Models.Analise", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<string>("AmostraId")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<int?>("AmostraId1")
                        .HasColumnType("int");

                    b.Property<DateTime>("Create_at")
                        .HasColumnType("datetime(6)");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<bool>("Laudo")
                        .HasColumnType("tinyint(1)");

                    b.Property<string>("Observacao")
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<string>("SolucaoId")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<int?>("SolucaoId1")
                        .HasColumnType("int");

                    b.HasKey("Id");

                    b.HasIndex("AmostraId1");

                    b.HasIndex("SolucaoId1");

                    b.ToTable("Analise");
                });

            modelBuilder.Entity("LIMS.Models.Calibracao", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<DateTime>("Calibrado")
                        .HasColumnType("datetime(6)");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<int>("EquipamentoId")
                        .HasColumnType("int");

                    b.Property<DateTime>("Validade")
                        .HasColumnType("datetime(6)");

                    b.HasKey("Id");

                    b.HasIndex("EquipamentoId");

                    b.ToTable("Calibracoes");
                });

            modelBuilder.Entity("LIMS.Models.Equipamento", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<DateTime>("Create_at")
                        .HasColumnType("datetime(6)");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("Nome")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<string>("NotaFiscal")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<int>("TipoEquipamentoId")
                        .HasColumnType("int");

                    b.Property<decimal>("Valor")
                        .HasColumnType("decimal(65,30)");

                    b.HasKey("Id");

                    b.HasIndex("TipoEquipamentoId");

                    b.ToTable("Equipamentos");
                });

            modelBuilder.Entity("LIMS.Models.Padrao", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<DateTime>("Create_at")
                        .HasColumnType("datetime(6)");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("Nome")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<string>("NotaFiscal")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<int>("UnidadeId")
                        .HasColumnType("int");

                    b.Property<DateTime>("Validade")
                        .HasColumnType("datetime(6)");

                    b.Property<decimal>("Valor")
                        .HasColumnType("decimal(65,30)");

                    b.Property<double>("Volume")
                        .HasColumnType("double");

                    b.HasKey("Id");

                    b.HasIndex("UnidadeId");

                    b.ToTable("Padroes");
                });

            modelBuilder.Entity("LIMS.Models.Solucao", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<DateTime>("Create_at")
                        .HasColumnType("datetime(6)");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<int>("EquipamentoId")
                        .HasColumnType("int");

                    b.Property<int>("PadraoId")
                        .HasColumnType("int");

                    b.Property<int>("SolventeId")
                        .HasColumnType("int");

                    b.Property<int>("UnidadeId")
                        .HasColumnType("int");

                    b.Property<DateTime>("Validade")
                        .HasColumnType("datetime(6)");

                    b.Property<double>("Volume")
                        .HasColumnType("double");

                    b.HasKey("Id");

                    b.HasIndex("EquipamentoId");

                    b.HasIndex("PadraoId");

                    b.HasIndex("SolventeId");

                    b.HasIndex("UnidadeId");

                    b.ToTable("Solucoes");
                });

            modelBuilder.Entity("LIMS.Models.Solvente", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("Nome")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.HasKey("Id");

                    b.ToTable("Solventes");
                });

            modelBuilder.Entity("LIMS.Models.TipoEquipamento", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("Tipo")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.HasKey("Id");

                    b.ToTable("TiposEquipamento");
                });

            modelBuilder.Entity("LIMS.Models.Unidade", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("UN")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.HasKey("Id");

                    b.ToTable("Unidades");
                });

            modelBuilder.Entity("LIMS.Models.Usuario", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    b.Property<string>("Conta")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<DateTime>("Delete_at")
                        .HasColumnType("datetime(6)");

                    b.Property<string>("Nome")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.Property<string>("Senha")
                        .IsRequired()
                        .HasColumnType("longtext CHARACTER SET utf8mb4");

                    b.HasKey("Id");

                    b.ToTable("Usuario");
                });

            modelBuilder.Entity("LIMS.Models.Amostra", b =>
                {
                    b.HasOne("LIMS.Models.Usuario", "Usuario")
                        .WithMany()
                        .HasForeignKey("UsuarioId1");
                });

            modelBuilder.Entity("LIMS.Models.Analise", b =>
                {
                    b.HasOne("LIMS.Models.Amostra", "Amostra")
                        .WithMany("Analise")
                        .HasForeignKey("AmostraId1");

                    b.HasOne("LIMS.Models.Solucao", "Solucao")
                        .WithMany()
                        .HasForeignKey("SolucaoId1");
                });

            modelBuilder.Entity("LIMS.Models.Calibracao", b =>
                {
                    b.HasOne("LIMS.Models.Equipamento", "Equipamento")
                        .WithMany("Calibracao")
                        .HasForeignKey("EquipamentoId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();
                });

            modelBuilder.Entity("LIMS.Models.Equipamento", b =>
                {
                    b.HasOne("LIMS.Models.TipoEquipamento", "TipoEquipamento")
                        .WithMany()
                        .HasForeignKey("TipoEquipamentoId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();
                });

            modelBuilder.Entity("LIMS.Models.Padrao", b =>
                {
                    b.HasOne("LIMS.Models.Unidade", "Unidade")
                        .WithMany()
                        .HasForeignKey("UnidadeId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();
                });

            modelBuilder.Entity("LIMS.Models.Solucao", b =>
                {
                    b.HasOne("LIMS.Models.Equipamento", "Equipamento")
                        .WithMany()
                        .HasForeignKey("EquipamentoId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.HasOne("LIMS.Models.Padrao", "Padrao")
                        .WithMany()
                        .HasForeignKey("PadraoId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.HasOne("LIMS.Models.Solvente", "Solvente")
                        .WithMany()
                        .HasForeignKey("SolventeId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.HasOne("LIMS.Models.Unidade", "Unidade")
                        .WithMany()
                        .HasForeignKey("UnidadeId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();
                });
#pragma warning restore 612, 618
        }
    }
}