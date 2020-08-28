using Microsoft.EntityFrameworkCore;

namespace LIMS.Models
{
    public class LimsContext : DbContext
    {
        public LimsContext(DbContextOptions<LimsContext> options)
            : base(options)
        {
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Calibracao>()
                .HasOne(p => p.Equipamento)
                .WithMany(b => b.Calibracao);

            modelBuilder.Entity<Analise>()
                .HasOne(p => p.Amostra)
                .WithMany(b => b.Analise);
        }

        public DbSet<Amostra> Amostra { get; set; }
        public DbSet<Analise> Analise { get; set; }
        public DbSet<Calibracao> Calibracoes { get; set; }
        public DbSet<Equipamento> Equipamentos { get; set; }
        public DbSet<Padrao> Padroes { get; set; }
        public DbSet<Solucao> Solucoes { get; set; }
        public DbSet<Solvente> Solventes { get; set; }
        public DbSet<TipoEquipamento> TiposEquipamento { get; set; }
        public DbSet<Unidade> Unidades { get; set; }
        public DbSet<Usuario> Usuario { get; set; }
    }
}